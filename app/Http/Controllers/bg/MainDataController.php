<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Collection;
use App\transaction;
use App\maindatum;
use App\attachment;
use Illuminate\Http\Request;
use App\Http\Requests;
use Carbon\Carbon;
use App\History;
use auth;
use DB;
class MainDataController extends Controller
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
        return view('home');
    }

    public function add()
    {
        return view('add');
    }
    public function checkcode($code)
    {
        $result = 0;
        $olddatacount = maindatum::Where('code', $code)->count();
        if($olddatacount>0){
            $result = 1;
        }
        return $result;
    }
    public function insert(Request $request)
    {   //upload image
        $image = $request->file('image');
        $filename = time().rand(1, 999).rand(1, 999).'.'.$image->getClientOriginalExtension();                
        $image->move( public_path().'/images/',$filename); 

        //insert data      
        $data = new maindatum;
        $data->code = $request->code;
        $data->date = $request->date;
        $data->name = $request->name;
        $data->tel = $request->tel;
        $data->type = $request->type;
        $data->description = $request->description;
        $data->generation = $request->generation;
        $data->color = $request->color;
        $data->licenseplate = $request->licenseplate;
        $data->amount = $request->amount;
        $data->percent = $request->percent;
        $data->interest = $request->interest;
        $data->islock = $request->islock;
        $data->image = $filename;
        $data->status = 1;
        $data->save();
        
        //upload attachment
        if($request->hasFile('attachment')){
            $count = $request->file('attachment');
            $description = $request->get('attachName'); // assign array of descriptions
            $attachment = $request->file('attachment'); // assign array of images
            $num = count($count);
            for($i = 0; $i < $num; $i++) {
                if(isset($attachment[$i])){
                    $attfile = $attachment[$i];
                    $filenames = time().rand(1, 999).rand(1, 999).'.'.$attfile->getClientOriginalExtension();                
                    $attfile->move( public_path().'/attachment/',$filenames); 
                    
                    $attachments = new attachment;
                    $attachments->path = $filenames;
                    $attachments->name = $description[$i];
                    $attachments->maindata_id = $data->id;
                    $attachments->save();
                }
            }
        }
        $date = Carbon::createFromFormat('Y-m-d', $request->date);
        $date->addMonthsNoOverflow(1);

        $transection = new transaction;
                $transection->date = $date;
                $transection->status = 0;
                $transection->note = "ยังไม่ชำระเงิน";
                $transection->staff_Id = 999;
                $transection->maindata_Id = $data->id;
                $transection->amount = 0;
                $transection->save();

        $history = new History;
        $history->maindata_id=$data->id;
        $history->note="เพิ่มข้อมูล";
        $history->action="Create New";
        $history->staff_id = Auth::user()->id;
        $history->save();

        return redirect('/detail/'.$data->id);
    }

    public function listing(Request $request)
    {
        $keyword = $request->keyword;
        $perPage = 10;
        if($request->keyword=="All"){
            $keyword="";
        }

        if (!empty($keyword)) {
            $data = maindatum::Where('code', 'LIKE', "%$keyword%")  
                ->orWhere('name', 'LIKE', "%$keyword%")
                ->orWhere('tel', 'LIKE', "%$keyword%")
                ->orWhere('type', 'LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->orWhere('generation', 'LIKE', "%$keyword%")
                ->orWhere('color', 'LIKE', "%$keyword%")   
                ->orWhere('licenseplate', 'LIKE', "%$keyword%") 
                ->latest()
                ->paginate($perPage);
                
               // return dd($saleorder);
        } else {
            
            $data = maindatum::orderBy('id', 'desc')->paginate($perPage);

        }
       
       return view('listing',compact('data')); 
       //return $_GET['keyword'];
    }

    public function detail($id)
    {
        $data = maindatum::Where('id', $id)->first();
        $att = attachment::Where('maindata_id', $id)->get();
        $history = DB::table('histories')
        ->select('users.name','histories.*')
        ->join('users', 'histories.staff_Id', '=', 'users.id')
        ->Where('histories.maindata_id', '=',$id)
        ->orderBy('created_at', 'asc')
        ->get();//History::Where('maindata_id', $id)->get();
        $transection = DB::table('transactions')
        ->select('users.name','transactions.*')
        ->join('users', 'transactions.staff_Id', '=', 'users.id')
        ->Where('transactions.maindata_id', '=',$id)
        ->orderBy('date', 'asc')
        ->get();
        
        $datenow = Carbon::now()->toDateString();
        $datadate = Carbon::createFromFormat('Y-m-d', $data->date);
        $tranlast = transaction::where('maindata_id', $id)->orderBy('created_at', 'desc')->count();
        $date = Carbon::createFromFormat('Y-m-d', $data->date);
        $date->addMonthsNoOverflow($tranlast+1);
        $datenext = $date->toDateString();
        return view('detail',compact('data','att','transection','datenext','history','datenow'));
    }

    public function editmaindata(Request $request){
        //upload image
        $old = maindatum::Where('id',$request->id)->first();
        if($request->hasFile('image')){
            $image = $request->file('image');
            $filename = time().rand(1, 999).rand(1, 999).'.'.$image->getClientOriginalExtension();                
            $image->move( public_path().'/images/',$filename); 
        }
        $message="";
        if($old->status!=$request->status){$message=$message."แก้ไขสถานะบัญชีจาก:".($old->status==1?"เปิดบัญชี":"ปิดบัญชี")." เป็น:".($request->status=="1"?"เปิดบัญชี":"ปิดบัญชี")."</br>"; }
        if($old->code!=$request->code){$message=$message."แก้ไขรหัสจาก:".$old->code." เป็น:".$request->code."</br>"; }
        if($old->date!=$request->date){$message=$message."แก้ไขวันที่จาก:".$old->date." เป็น:".$request->date."</br>"; }
        if($old->name!=$request->name){$message=$message."แก้ไขชื่อจาก:".$old->name." เป็น:".$request->name."</br>"; }
        if($old->tel!=$request->tel){$message=$message."แก้ไขเบอร์โทรจาก:".$old->tel." เป็น:".$request->tel."</br>"; }
        if($old->type!=$request->type){$message=$message."แก้ไขประเภทจาก:".$old->type." เป็น:".$request->type."</br>"; }
        if($old->description!=$request->description){$message=$message."แก้ไขรายละเอียดจาก:".$old->description." เป็น:".$request->description."</br>"; }
        if($old->generation!=$request->generation){$message=$message."แก้ไขยี่ห้อ/รุ่นจาก:".$old->generation." เป็น:".$request->generation."</br>"; }
        if($old->color!=$request->color){$message=$message."แก้ไขสีจาก:".$old->color." เป็น:".$request->color."</br>"; }
        if($old->licenseplate!=$request->licenseplate){$message=$message."แก้ไขเลขทะเบียนจาก:".$old->licenseplate." เป็น:".$request->licenseplate."</br>"; }
        if($old->amount!=$request->amount){$message=$message."แก้ไขเงินต้นจาก:".$old->amount." เป็น:".$request->amount."</br>"; }
        if($old->percent!=$request->percent){$message=$message."แก้ไขเปอร์เซ็นจาก:".$old->percent." เป็น:".$request->percent."</br>"; }
        if($old->islock!=$request->islock){$message=$message."แก้ไขล็อคจาก:".$old->islock." เป็น:".$request->islock."</br>"; }
        if($old->interest!=$request->interest){$message=$message."คำนวณเงินใหม่จาก:".$old->interest." เป็น:".$request->interest."</br>"; }
        if($request->hasFile('image')){$message=$message."อัพโหลดรูปใหม่จาก:".$old->image." เป็น:".$filename."</br>"; }

        //insert data  
          
        $data = maindatum::find($request->id);
        $data->code = $request->code;
        $data->date = $request->date;
        $data->name = $request->name;
        $data->tel = $request->tel;
        $data->type = $request->type;
        $data->description = $request->description;
        $data->generation = $request->generation;
        $data->color = $request->color;
        $data->licenseplate = $request->licenseplate;
        $data->amount = $request->amount;
        $data->percent = $request->percent;
        $data->interest = $request->interest;
        $data->islock = $request->islock;

        if($request->hasFile('image')){
            $data->image = $filename;
        }
        
        $data->status = $request->status;;
        $data->save();
       
        $history = new History;
        $history->maindata_id=$request->id;
        $history->note="แก้ไขข้อมูลหลัก <br />".$message;
        $history->action="Edit Data";
        $history->staff_id = Auth::user()->id;
        $history->save();
        return back()->withInput();
        
    }
    
    public function countdata($type){
        $report = "เกิดข้อผิดพลาดขึ้น โปรดลองอีกครั้ง";
        if($type=="All"){
            $count = maindatum::Where('status',1)->count();
            $sumamount = maindatum::Where('status',1)->sum('amount');
        }
        else{
            $count = maindatum::Where('type',$type)->Where('status',1)->count();
            $sumamount = maindatum::Where('type',$type)->Where('status',1)->sum('amount');
        }
        
        $report = "<div class='col-sm-6'>มีจำนวน <span style='color:#7dc855' id='countlist'><b>".$count."</b></span> รายการ</div><div class='col-sm-6'> ยอดเงิน: <span style='color:#7dc855' id='countamount'><b>".number_format($sumamount, 0)."</b></span> บาท</div> ";
        return $report;
    }
}
