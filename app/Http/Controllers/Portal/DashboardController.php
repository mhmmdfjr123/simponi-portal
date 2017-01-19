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
     * Show the dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('portal.dashboard.index');
    }
}
