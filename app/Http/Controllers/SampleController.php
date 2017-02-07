<?php

namespace App\Http\Controllers;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class SampleController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        return view('sample.register');
    }

	public function applynew()
	{
		return view('sample.applynew');
	}

	public function customer()
	{
		return view('sample.customer');
	}

	public function userlogin()
	{
		return view('sample.userlogin');
	}
}
