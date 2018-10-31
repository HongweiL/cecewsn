<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('/contents/home');
    }

    /**
     * Show home page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home() {
        return view('/contents/home');
    }
    
    /**
     * Get server usage
     *
     * @return server usage
     */
    public function getUsage() {
        return array("cpu" => shell_exec("top -bn 2 -d 0.5 | grep '^%Cpu' | tail -n 1 | gawk '{print $2+$4+$6}'"), 
                    "ram" => shell_exec("free -h | sed -n 2p | gawk '{print ($2-$4)/$2}'"));
    }

    /**
     * Get statics of uploading data
     *
     * @return array
     */
    public function getStat() {
        $current = new \DateTime('now');
        $arrD = array();
        $arrM = array();
        for ($i = 0; $i < 15; $i++) {
            array_unshift($arrD, $current -> format('d-M'));
            array_unshift($arrM, count(DB::select("select * from jobs where DATE_FORMAT(create_time, '%Y-%m-%d') ='".$current -> format('Y-m-d')."'")));
            $current -> modify("-1 day");
        }
        echo json_encode(array('date' => $arrD, 'main' => $arrM));
    }
}
