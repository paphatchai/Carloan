<?php

namespace App\Http\Controllers;
use auth;
use App\maindatum;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\transaction;
use App\History;
use Carbon\Carbon;

class UpdateTransectionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */ 
    
    public function updatetransection()
    {
        $count =0;
        $data = maindatum::select('id')->Where('status', 1)->get();
        foreach($data as $item){
            $datamain = maindatum::Where('id',$item->id)->first();
            $tranlast = transaction::where('maindata_id',$item->id)->count();
            $tranlasttion = transaction::where('maindata_id', $item->id)->orderBy('date', 'desc')->first();
            $datamaindate = Carbon::createFromFormat('Y-m-d', $tranlasttion->date);
            //$datamaindate->addMonthsNoOverflow(+1);
            $now = Carbon::now();
            $start=$datamaindate->year.$datamaindate->format('m');
            $end = $now->year.$now->format('m');
            if($start>=$end){
                echo "<div style='color:green'><br/>".$item->id."T".$start.'|'.$end."</div>";
            }
            else{
                
               $transection = new transaction;
               $transection->date = $datamaindate->addMonthsNoOverflow(+1);
               $transection->status = 0;
               $transection->note = "ยังไม่ชำระเงิน";
               $transection->staff_Id = 999;
               $transection->maindata_Id = $item->id;
               $transection->amount = 0;
               $transection->save();
               $count++;
               echo "<div style='color:red'><br/>".$item->id."F".$start.'|'.$end.'</div>';
            }
        }
     
        /*
        $tranlast = transaction::whereIn('maindata_id', $data)->Where('date', 1)->get();
        $check = $transection = DB::table('maindatas')
        ->join('transactions','maindatas.id' , '=', 'transactions.maindata_id')
        ->select()
        ->Where('maindatas.status', '=',1)
        ->whereMonth('transactions.date', '=', date('m'))
        ->whereYear('transactions.date', '=', date('Y'))
        ->get();

        */
        return "<br/><h1>สรุปยอด:".$count."</h1>";
        //return redirect('/home');
    }
}
