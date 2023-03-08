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

class TransectionController extends Controller
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
    public function insertnext(Request $request)
    {
        $datamain = maindatum::Where('id',$request->maindata_Id)->first();
        $transection = new transaction;
                $transection->date = $request->date;
                $transection->status = $request->amount==$datamain->interest?2:1;
                $transection->note = $request->note;
                $transection->staff_Id = Auth::user()->id;
                $transection->maindata_Id = $request->maindata_Id;
                $transection->amount = $request->amount;
                $transection->save();

        $history = new History;
                $history->maindata_id=$request->maindata_Id;
                $history->note="รับเงินของวันที่:".$request->date."<br />จำนวน:".$request->amount." บาท<br /> สถานะ:".($request->amount==$datamain->interest?"ชำระครบถ้วน":"ชำระบางส่วน" )."<br />ข้อความ:".$request->note;
                $history->action="Create Transection";
                $history->staff_id = Auth::user()->id;
                $history->save();

        return back()->withInput();
    }
    public function edittransection(Request $request)
    {
        $id = $request->transec_id;
        $oldtransec = transaction::where('id',$id)->first();
        $datamain = maindatum::Where('id',$request->maindata_Id)->first();
        $message = "";
        if($oldtransec->note!=$request->note){$message=$message."แก้ไขบันทึกจาก:".$oldtransec->note." เป็น:".$request->note."</br>"; }
        if($oldtransec->amount!=$request->amount){$message=$message."แก้ไขยอดเงินรับจาก:".$oldtransec->amount." เป็น:".$request->amount."</br>"; }
        if($oldtransec->status!=($request->amount==$datamain->interest?2:1)){$message=$message."แก้ไขสถานะจาก:".($oldtransec->amount==$datamain->interest?"ชำระครบถ้วน":"ชำระบางส่วน")." เป็น:".($request->amount==$datamain->interest?"ชำระครบถ้วน":"ชำระบางส่วน")."</br>"; }
        
        $transection = transaction::find($id);
        $transection->status = $request->amount==$datamain->interest?2:1;
        $transection->note = $request->note;
        $transection->staff_Id = Auth::user()->id;
        $transection->maindata_Id = $request->maindata_Id;
        $transection->amount = $request->amount;
        $transection->save();
        
        $history = new History;
                $history->maindata_id=$request->maindata_Id;
                $history->note="แก้ไข Transection วันที่:".$oldtransec->date."<br />".$message;
                $history->action="Edit Transection";
                $history->staff_id = Auth::user()->id;
                $history->save();

        return back()->withInput();
        
    }
    public function delete($id)
    {
        if(Auth::user()->isactive==0){
            Auth::logout();
            return back()->withInput();
        }
        
        $oldtransec = transaction::where('id',$id)->first();
        $datamain = maindatum::Where('id',$oldtransec->maindata_Id)->first();
        $message = "";
        $message=$message."บันทึก:".$oldtransec->note."</br>"; 
        $message=$message."ยอดเงินรับ:".$oldtransec->amount."</br>"; 
        if($oldtransec->status==0){$message=$message."สถานะ: ยังไม่ชำระ</br>"; }
        else if($oldtransec->status==1){$message=$message."สถานะ: ชำระบางส่วน</br>"; }
        else{$message=$message."สถานะ: ชำระครบถ้วน</br>"; }
        
        
        $transection = transaction::find($id);
        $transection->delete();
        
        $history = new History;
                $history->maindata_id=$oldtransec->maindata_Id;
                $history->note="ลบ Transection วันที่:".$oldtransec->date."<br />".$message;
                $history->action="Delete Transection";
                $history->staff_id = Auth::user()->id;
                $history->save();

        return back()->withInput();
        
    }

    public function updatetransection()
    {
        if(Auth::user()->isactive==0){
            Auth::logout();
            return back()->withInput();
        }

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
                //echo "t".$start.'|'.$end;
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
               //echo "f".$start.'|'.$end.'<br/>';
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
        return redirect('/home');
    }
}
