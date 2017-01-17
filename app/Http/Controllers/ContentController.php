<?php

namespace App\Http\Controllers;

/**
 * Class ContentController
 * @package App\Http\Controllers
 * @author rma
 */
class ContentController extends Controller
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
    public function index()
    {
        return view('content');
    }

    public function simulation()
    {
        return view('simulation');
    }
    
}
