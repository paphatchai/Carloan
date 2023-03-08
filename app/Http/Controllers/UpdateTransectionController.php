<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\maindatum;
use App\transaction;
use Carbon\Carbon;

class UpdateTransectionController extends Controller
{

 public function __construct()
 {
 }

 public function updatetransection()
 {
  $count = 0;
  $data  = maindatum::select('id')->Where('status', 1)->get();
  foreach ($data as $item) {
   //$tranlast     = transaction::where('maindata_id', $item->id)->count();
   $tranlasttion = transaction::where('maindata_id', $item->id)->orderBy('date', 'desc')->first();
   if ($tranlasttion) {
    $datamaindate = Carbon::createFromFormat('Y-m-d', $tranlasttion->date);

    $now   = Carbon::now();
    $start = $datamaindate->year . $datamaindate->format('m');
    $end   = $now->year . $now->format('m');
    if ($start >= $end) {
     echo "<div style='color:green'><br/>" . $item->id . "T" . $start . '|' . $end . "</div>";
    } else {

     $transection              = new transaction;
     $transection->date        = $datamaindate->addMonthsNoOverflow(+1);
     $transection->status      = 0;
     $transection->note        = "ยังไม่ชำระเงิน";
     $transection->staff_Id    = 999;
     $transection->maindata_Id = $item->id;
     $transection->amount      = 0;
     $transection->save();
     $count++;
     echo "<div style='color:red'><br/>" . $item->id . "F" . $start . '|' . $end . '</div>';
    }
   }
  }

  return "<br/><h1>สรุปยอด:" . $count . "</h1>";
 }
}
