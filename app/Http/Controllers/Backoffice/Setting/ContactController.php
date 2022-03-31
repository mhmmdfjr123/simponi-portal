<?php namespace App\Http\Controllers\Backoffice\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller {

    private $rules = [
        'email' => 'required|email'
    ];

    public function __construct(){

    }

    public function getIndex(){
        $data = [
            'pageTitle' => 'Pengaturan Kontak'
        ];

        return view('backoffice.setting.contact.getIndex', $data);
    }

    public function postSubmit(Request $request){
        $response = array();

        $isFailed = false;

        if(isset($this->rules[$request->input('pk')])){
            $v = Validator::make($request->all(), [
                'value' => $this->rules[$request->input('pk')]
            ]);

            $isFailed = $v->fails();
        }

        if ($isFailed){
            $response['message'] = $v->messages();
            $response['status'] = 'error';
        }else{
            $response['status'] = 'ok';

            // Settings::set($request->input('pk'), $request->input('value'));
        }

        return response()->json($response);
    }
}