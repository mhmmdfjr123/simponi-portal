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
    public function __construct() {

    }

    /**
     * Show the simulation form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSimulationBasedOnContrib() {
        return view('simulation.simulation', [
        	'pageTitle' => 'Simulasi BNI Simponi Berdasarkan Iuran.'
        ]);
    }
    public function showSimulationBasedOnNeeds()
    {
        return view('simulation.simulationrev', [
        	'pageTitle' => 'Simulasi BNI Simponi Berdasarkan Kebutuhan.'
        ]);
    }
}
