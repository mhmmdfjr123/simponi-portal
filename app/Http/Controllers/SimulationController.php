<?php

namespace App\Http\Controllers;

/**
 * Class ContentController
 * @package App\Http\Controllers
 * @author rma
 */
class SimulationController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {

    }

    /**
     * Show the simulation form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSimulationForm()
    {
        return view('simulation.simulation');
    }
    public function showSimulationRevForm()
    {
        return view('simulation.simulationrev');
    }
}
