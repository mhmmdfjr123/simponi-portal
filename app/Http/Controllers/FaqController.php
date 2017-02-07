<?php

namespace App\Http\Controllers;

/**
 * Class HomeController
 * @package App\Http\Controllers
 * @author efriandika
 */
class FaqController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    /**
     * Show the faq index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('faq.index');
    }
}
