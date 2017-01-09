<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class ProfileController
 * @package App\Http\Controllers\Backoffice
 * @author efriandika
 */
class ProfileController extends Controller {
    private $auth;

    public function __construct(Guard $auth){
        $this->auth = $auth;
    }

    public function index(){
        return redirect('backoffice/profile/edit');
    }

    public function showEditForm(){
        $data = [
            'pageTitle' => 'Profile Saya: '.$this->auth->user()->name,
            'obj'       => User::find($this->auth->user()->id)
        ];

        return view('backoffice.profile.index', $data);
    }

    public function postEdit(Request $request){
        try {
            $account = User::find($request->input('id'));

            $account->username = $request->input('username');
            $account->email    = $request->input('email');
            $account->name = $request->input('name');
            $account->date_of_birth = date('Y-m-d', strtotime($request->input('date_of_birth')));
            $account->gender      = $request->input('gender');
            $account->address  = $request->input('address');
            $account->phone_mobile = $request->input('phone_mobile');

            $account->save();

            return redirect('backoffice/profile/edit')->with('success', 'Profile berhasil disimpan.');
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return redirect('backoffice/profile/edit')->withErrors([
                'Telah terjadi sesuatu kesalahan. Silahkan ulangi beberapa saat lagi atau hubungi administrator.'
            ]);
        }
    }

    public function showChangePasswordForm(){
        return view('backoffice.profile.changePassword');
    }

    public function postChangePassword(Request $request){
        try {
            $account = User::find($this->auth->user()->id);

            if(count($account) > 0 && Hash::check($request->input('old-password'), $account->password)){
                $account->password = bcrypt($request->input('password'));
                $account->save();

                return response()->json([
                    'status'    => 'ok',
                    'message'   => 'Selamat..!! Password anda berhasil diganti.'
                ]);
            } else {
                return response()->json([
                    'status'    => 'error',
                    'message'   => 'Password Lama anda salah.'
                ]);
            }
        } catch (QueryException $e) {
            \Log::error($e->getMessage());

            return response()->json([
                'status'        => 'error',
                'message'       => 'Password gagal disimpan.'
            ]);
        }
    }
}