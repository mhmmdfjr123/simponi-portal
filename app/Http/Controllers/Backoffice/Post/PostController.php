<?php namespace App\Http\Controllers\Backoffice\Post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Facades\Datatables;

class PostController extends Controller {

    public function __construct(){

    }

    public function index(Post $postModel){
    	$data = [
            'pageTitle' => 'Daftar Artikel',
            'countListAllPage' => $postModel::count(),
            'countListTrashPage' => $postModel::onlyTrashed()->count(),
            'listStatus' => $postModel->getListStatus()
        ];

        return view('backoffice.post.post.index', $data);
    }

    public function listData(Request $request, Post $post){
        $status = $request->get('postStatus');

        $data = $post->select(['id', 'title', 'status', 'created_at', 'deleted_at', 'publish_date_start', 'publish_date_end']);

        $data->orderBy('created_at', 'desc');

        if($status != '' && strtolower($status) == "deleted"){
            $data->onlyTrashed();
        }else if($status != '')
            $data->where("status", $status);

        $rowNum = 1;
        $startPage = $request->get('start');

        return Datatables::of($data)
            ->addColumn('rownum', function () use (&$rowNum, $startPage) {
                return $startPage + ($rowNum++);
            })
            ->editColumn('status', function ($model) {
                if($model->deleted_at == '')
                    return pageStatusTextWithStyle($model->status, $model->publish_date_start, $model->publish_date_end);
                else
                    return '-';
            })
            ->addColumn('created_date', function ($model) {
                if($model->status == 'P' && $model->deleted_at == '')
                    return date('d-m-Y H:i:s', strtotime($model->created_at));
                else
                    return '-';
            })
            ->addColumn('action', function ($model) {
                if($model->deleted_at == ''){
                    $button = '
                        <div class="btn-group">
                            <a href="'.url('backoffice/post/'.$model->id.'/edit').'" title="Ubah" class="btn btn-xs btn-default"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/post/'.$model->id.'/delete').'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus?\', \'Ya, Hapus Data\', \'Tidak\');" title="Hapus" class="btn btn-xs btn-default"><i class="fa fa-trash"></i></a>
                        </div>
                    ';
                }else{
                    $button = '
                        <div class="btn-group btn-group-xs">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-caret-down"></i></button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/post/'.$model->id.'/delete/restore').'\', \'Konfirmasi\', \'Apakah anda yakin ingin membatalkan penghapusan data ini?\', \'Ya, restore data\', \'Tidak\');" ><i class="fa fa-rotate-left"></i> Restore Data</a></li>
                                <li><a href="javascript:void(0)" onclick="confirmDirectPopUp(\''.url('backoffice/post/'.$model->id.'/delete/force').'\', \'Konfirmasi\', \'Apakah anda yakin ingin menghapus data ini secara permanen?<br />Info: Data yang sudah dihapus permanan <strong>tidak dapat dipulihkan</strong> kembali\', \'Ya, Hapus Permanen\', \'Tidak\');" ><i class="fa fa-times"></i> Hapus Permanen</a></li>
                            </ul>
                        </div>
                    ';
                }

                return $button;
            })
	        ->rawColumns(['rownum', 'status', 'created_date', 'action'])
            ->make(true);
    }

    public function add(PostCategory $postCategory){
        $data = [
            'pageTitle' => 'Tambah Artikel',
            'listCategory' => $postCategory->listHierarchy()
        ];

        return view('backoffice.post.post.add', $data);
    }

    public function edit(Post $postModel, PostCategory $postCategory, $id){
        $post = $postModel->find($id);

        if(count($post) == 0)
            return redirect('backoffice/post')->withErrors(['notFound', 'Data tidak ditemukan']);

        $data = [
            'pageTitle'  => 'Ubah Artikel',
            'listCategory' => $postCategory->listHierarchy(),
            'obj'        => $post
        ];

        return view('backoffice.post.post.edit', $data);
    }

    public function submit(Post $postModel, Request $request){
        try{
            if($request->input('id') != ''){
                $post = $postModel->find($request->input('id'));
                $post->updated_by = Auth::user()->id;
            }else{
                $post = new Post();
                $post->created_by = Auth::user()->id;
            }

            // Set alias
            $aliasQuery = $postModel->where('alias', $request->input('alias'));
            if($request->input('alias_old') != ''){
                $aliasQuery->where('alias', '<>', $request->input('alias_old'));
            }

            $alias = $request->input('alias');

            if($aliasQuery->count() > 0){
                $alias = $alias.'-'.time();
            }

            //Set status
            if($request->input('status') == 'P')
                $status = 'P';
            else
                $status = 'D';

            $post->title = $request->input('title');
            $post->alias = $alias;
            $post->content = $request->input('content');
            $post->meta_key = $request->input('meta_key');
            $post->meta_desc = $request->input('meta_desc');
            $post->status = $status;
            $post->publish_date_start = date('Y-m-d H:i:s', strtotime($request->input('publish_date_start').' '.$request->input('publish_time_start')));

            $post->save();

            // Sync category
            if(count($request->input('categories')) > 0)
                $post->categories()->sync($request->input('categories'));
            else
                $post->categories()->sync([]);

            return redirect('backoffice/post/'.$post->id.'/edit')->with('success', 'Data berhasil disimpan.');
        }catch (QueryException $e){
            \Log::error($e->getMessage());

            return redirect('backoffice/post')->withErrors([
                'Gagal menyimpan data. Ulangi beberapa saat lagi.'
            ]);
        }
    }

    public function delete($id){
        try {
            $obj = Post::find($id);

            if(count($obj) > 0){
                $obj->delete();
                return redirect('backoffice/post')->with('success', 'Data berhasil dihapus.');
            }else{
                return redirect('backoffice/post')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/post')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    public function restoreDeletedData(Post $postModel, $id){
        try {
            $obj = $postModel::onlyTrashed()->find($id);

            if(count($obj) > 0){
                $obj->restore();

                return redirect('backoffice/post')->with('warning', 'Data telah dipulihkan dari daftar hapus (trash).');
            }else{
                return redirect('backoffice/post')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/post')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    public function forceDelete(Post $postModel, $id){
        try {
            $obj = $postModel::onlyTrashed()->find($id);

            if(count($obj) > 0){
                $obj->forceDelete();

                return redirect('backoffice/post')->with('success', 'Data #'.$obj->id.' telah dihapus secara permanen.');
            }else{
                return redirect('backoffice/post')->withErrors([
                    'Data tidak ditemukan.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/post')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }
}