<?php

namespace App\Http\Controllers;

use App\transaction;
use App\maindatum;
use App\attachment;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use DB;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countdata = maindatum::count();
        $now = Carbon::now();
        $datamaincount = transaction::select('maindata_id')->Where('date',$now->toDateString())->Where('status','=',0)->get();
        $datamain = maindatum::WhereIn('id',$datamaincount)->Where('status',1)->get();
        return view('home',compact('countdata','now','datamain','datamaincount'));
        //return dd($datamain);
    }
}
