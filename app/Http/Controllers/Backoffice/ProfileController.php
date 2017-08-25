<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;
use App\Models\PasswordHistory;
use App\Models\User;
use App\Services\Encryption\RsaService;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

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

    public function showChangePasswordForm(RsaService $rsaService){
        return view('backoffice.profile.changePassword', [
            'publicKey' => $rsaService->getPublicKey()
        ]);
    }

    public function postChangePassword(Request $request, RsaService $rsaService){
        try {
            $account = User::find($this->auth->user()->id);

            $oldPassword = $rsaService->decrypt($request->input('old-password'));
            $password = $rsaService->decrypt($request->input('password'));

            if(count($account) > 0 && Hash::check($oldPassword, $account->password)){
                // Check Password History
                $passwordHistoryTest = null;
                foreach (PasswordHistory::where('user_id', $account->id)->get() as $history) {
                    if (Hash::check($password, $history->password)) {
                        $passwordHistoryTest = $history;
                        break;
                    }
                };

                if (!is_null($passwordHistoryTest)) {
                    return response()->json([
                        'status'    => 'error',
                        'message'   => 'Gagal mengganti password. Anda pernah menggunakan password yang sama pada '.$passwordHistoryTest->created_at->formatLocalized('%A, %d %B %Y at %I:%M %p')
                    ]);
                } else {
                    // Save to history
                    $newPasswordHistory = new PasswordHistory();
                    $newPasswordHistory->user_id = $account->id;
                    $newPasswordHistory->password = bcrypt($password);
                    $newPasswordHistory->save();

                    // Remove > 4th histories
                    PasswordHistory::destroy(PasswordHistory::where('user_id', $account->id)
                        ->orderBy('created_at', 'desc')
                        ->skip(4)
                        ->limit(100)
                        ->get()
                        ->pluck('id')->toArray());
                }

                // Change Password
                $account->password = bcrypt($password);
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
        } catch (\Exception $e) {
            \Log::error($e->getMessage());

            return response()->json([
                'status'        => 'error',
                'message'       => $e->getMessage()
            ]);
        }
    }
}