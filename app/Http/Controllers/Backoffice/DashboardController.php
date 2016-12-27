<?php namespace App\Http\Controllers\Backoffice;

use App\Http\Controllers\Controller;

class DashboardController extends Controller {

    public function __construct(){

    }

    public function index(){
        $data = [
            'pageTitle' => 'Dashboard'
        ];

        return view('backoffice.dashboard.index', $data);
    }
}