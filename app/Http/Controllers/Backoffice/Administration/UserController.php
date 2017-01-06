<?php namespace App\Http\Controllers\Backoffice\Administration;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kodeine\Acl\Models\Eloquent\Role;
use Yajra\Datatables\Datatables;

class UserController extends Controller {
	public function __construct(){

	}

	public function index(User $user){
		$countListAll = $user->count();
		$countListTrash = $user->onlyTrashed()->count();

		$data = [
            'pageTitle' => 'Daftar Pengguna',
			'roles'		=> Role::orderBy('name')->get(),
            'countListAll' => $countListAll,
			'countListTrash' => $countListTrash,
			'listStatus' => $user->getListStatus()
		];

		return view('backoffice.administration.user.index', $data);
	}

	public function listData(Request $request){
        $status = $request->get('userStatus');
        $role = $request->get('userRole');
		
		$data = User::select(['users.id', 'users.name', 'users.username', 'users.email', 'users.status', 'users.deleted_at']);

        if($status != '' && strtolower($status) == "deleted"){
            $data->onlyTrashed();
        }else if($status != '')
            $data->where("users.status", $status);

        if($role != '' && strtolower($role) == "none"){
            $data->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('role_user')
                    ->whereRaw(DB::getTablePrefix().'role_user.user_id = '.DB::getTablePrefix().'users.id');
            });
        }else if($role != ''){
            $data->join('role_user', 'role_user.user_id', '=', 'users.id');
            $data->where('role_user.role_id', $role);
        }

        $rowNum = 1;
        $startPage = $request->get('start');

		return Datatables::of($data)
            ->addColumn('rownum', function () use (&$rowNum, $startPage) {
                return $startPage + ($rowNum++);
            })
            ->editColumn('role', function($model) {
                $rowRole = '<ul style="padding-left: 10px; margin: 0; list-style: square;">';
                foreach($model->roles as $role){
                    $rowRole .= '<li>'.$role->name.'</li>';
                }
                $rowRole .= '</ul>';

                return $rowRole;
            })
            ->editColumn('status', function($model){
                return ($model->deleted_at == '') ? userStatusTextWithStyle($model->status): '-';
            })
			->addColumn('action', function ($model) {
                if($model->deleted_at == ''){
                    if($model->id != -1 || $model->id != Auth::user()->id)
                        $button = '
                           <div class="btn-group">
                               <a href="'.url('backoffice/administration/user/edit/'.$model->id).'" title="Ubah" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                               <a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/administration/user/delete/'.$model->id).'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus user: '.$model->fullname.'\', \'Ya, Hapus user\', \'Tidak\');" title="Hapus" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>
                           </div>
                        ';
                    else
                        $button = '
                           <div class="btn-group">
                               <a href="'.url('backoffice/administration/user/edit/'.$model->id).'" title="Ubah" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                               <a href="javascript:void(0)" title="Hapus" class="btn btn-xs btn-default disabled"><i class="fa fa-trash"></i></a>
                           </div>
                        ';
                }else{
                    $button = '
                        <div class="btn-group btn-group-xs">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/administration/user/delete-restore/'.$model->id).'\', \'Konfirmasi\', \'Apakah anda yakin ingin membatalkan penghapusan data ini?\', \'Ya, restore data\', \'Tidak\');" ><i class="fa fa-rotate-left"></i> Restore Data</a></li>
                                <li><a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/administration/user/delete-permanent/'.$model->id).'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus data ini secara permanen?<br />Info: Data yang sudah dihapus permanan <strong>tidak dapat dipulihkan</strong> kembali\', \'Ya, Hapus Permanen\', \'Tidak\');" ><i class="fa fa-times"></i> Hapus Permanen</a></li>
                            </ul>
                        </div>
                    ';
                }

				return $button;
			})
			->make(true);
	}

	public function add(){
		$data = [
            'pageTitle' => 'Tambah Pengguna',
			'roles' => Role::all()
		];

		return view('backoffice.administration.user.add', $data);
	}

	public function edit($id){
		try {
			$obj = User::find($id);

			if(count($obj) > 0){
				$data = [
                    'pageTitle' => 'Ubah Pengguna',
					'obj'       => $obj,
					'roles'     => Role::all()
				];

				return view('backoffice.administration.user.edit', $data);
			}else{
				return redirect('backoffice/administration/user')->withErrors([
						'Data tidak ditemukan.'
				]);
			}
		} catch (QueryException $e) {
			\Log::error($e->getMessage());

			return redirect('backoffice/administration/user')->withErrors([
					'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
			]);
		}
	}

	public function delete($id){
		try {
			$obj = User::find($id);

			if(count($obj) > 0){
				$obj->delete();

				return redirect('backoffice/administration/user')->with('success', 'Data berhasil dihapus.');
			}else{
				return redirect('backoffice/administration/user')->withErrors([
						'Data tidak ditemukan.'
				]);
			}
		} catch (QueryException $e) {
			\Log::error($e->getMessage());

			return redirect('backoffice/administration/user')->withErrors([
					'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
			]);
		}
	}

	public function deleteRestore(User $userModel, $id){
		try {
			$obj = $userModel::onlyTrashed()->find($id);

			if(count($obj) > 0){
				$obj->restore();

				return redirect('backoffice/administration/user')->with('warning', 'Pengguna telah dipulihkan dari daftar hapus (trash).');
			}else{
				return redirect('backoffice/administration/user')->withErrors([
						'Data tidak ditemukan.'
				]);
			}
		} catch (QueryException $e) {
			\Log::error($e->getMessage());

			return redirect('backoffice/administration/user')->withErrors([
					'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
			]);
		}
	}

	public function deletePermanent(User $userModel, $id){
		try {
			$obj = $userModel::onlyTrashed()->find($id);

			if(count($obj) > 0){
				$obj->forceDelete();

				return redirect('backoffice/administration/user')->with('success', 'Pengguna #'.$obj->id.' telah dihapus secara permanen.');
			}else{
				return redirect('backoffice/administration/user')->withErrors([
						'Data tidak ditemukan.'
				]);
			}
		} catch (QueryException $e) {
			\Log::error($e->getMessage());

			return redirect('backoffice/administration/user')->withErrors([
					'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
			]);
		}
	}

	public function checkUsername(User $user, Request $request, $id = ""){
		if($request->get('username') != "" && $user->checkUsername($request->get('username'), $id)->count())
			return "false";
		else
			return "true";
	}

	public function checkEmail(User $user, Request $request, $id = ""){
		if($request->get('email') != "" && $user->checkEmail($request->get('email'), $id)->count())
			return "false";
		else
			return "true";
	}

	public function submit(Request $request){
		try {
			if($request->input('id') != ""){
				$user = User::find($request->input('id'));

				if(count($user) == 0){
					return redirect('backoffice/administration/user')->withErrors([
							'Data tidak ditemukan.'
					]);
				}
			}else{
				$user = new User();
			}

			$user->username = $request->input('username');
			$user->email    = $request->input('email');
			if($request->input('password') != "")
				$user->password = bcrypt($request->input('password'));
			$user->name = $request->input('name');
			$user->date_of_birth = date('Y-m-d', strtotime($request->input('date_of_birth')));
			$user->gender      = $request->input('gender');
			$user->address  = $request->input('address');
			$user->phone_mobile = $request->input('phone_mobile');

			$user->status   = $request->input('status');

			$user->save();

			// Sync Roles
			if(count($request->input('role')) > 0)
				$user->syncRoles($request->input('role'));
			else
				$user->revokeAllRoles();

			return redirect('backoffice/administration/user')->with('success', 'Data berhasil disimpan.');
		} catch (QueryException $e) {
			\Log::error($e->getMessage());

			return redirect('backoffice/administration/user')->withErrors([
					'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
			]);
		}
	}
}
