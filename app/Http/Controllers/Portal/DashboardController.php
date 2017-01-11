<?php namespace App\Http\Controllers\Portal;

use App\Http\Controllers\Controller;

/**
 * This class handle portal dashboard
 *
 * @package App\Http\Controllers
 * @author efriandika
 */
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo 'This is 7 - Dashboard';
    }
}
