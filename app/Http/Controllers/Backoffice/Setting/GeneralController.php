<?php namespace App\Http\Controllers\Backoffice\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller {

    public function __construct(){

    }

    public function getIndex(){
        $data = [
            'pageTitle' => 'Pengaturan Umum'
        ];

        return view('backoffice.setting.general.getIndex', $data);
    }

    public function postSubmit(Request $request){
        $response = array();

        $response['status'] = 'ok';

        return response()->json($response);
    }
}