@extends('layouts.dashboard')

@section('content')
<!-- Page Content -->
<div class="container-fluid p-y-md">
        <div class="row">
                <!-- Company overview Chart -->
                <div class="col-lg-8">
                        <div class="card">
                                <div class="card-header bg-{{$data->status==0?'red':'cyan'}} bg-inverse">
                                    <div class="h4">รายละเอียดข้อมูล รหัส: {{$data->code}}</div>
                                    <ul class="card-actions">
                                        <li  data-toggle="modal" data-target="#modal-slideleft">
                                                <span class="label bg-green">แก้ไขข้อมูล <i class="fa fa-pencil"></i></span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-block">
                                    <div class="row">
                                    <div class="col-md-5" style="padding-top:15px"><a href="{{asset('images/'.$data->image)}}" target="_blank"><img src="{{asset('images/'.$data->image)}}" width="100%" height="auto"></a></div>
                                    <div class="col-md-7" style="padding-top:15px">
                                        <b>ชื่อ:</b> <span style="color:#2196f3"> {{$data->name}} </span></br>
                                        <b>วันที่:</b><span style="color:#2196f3">  {{date('d/m/Y', strtotime($data->date))}}</span> @if($data->status==0)<span style="color:red">(ปิดบัญชีแล้ว)</span>@endif</br>
                                        <b>เบอร์โทร:</b><a href="tel:{{$data->tel}}"> <span style="color:#2196f3">  {{$data->tel}}</span> <i class="ion-ios-telephone" style="font-size:20px"></i></a></br>
                                        <b>ประเภท:</b><span style="color:#2196f3">  {{$data->type}}</span></br>
                                        <b>รายละเอียด: </b><span style="color:#2196f3">  {{$data->description}}</span></br>
                                        <b>ยี่ห้อ/รุ่น: </b><span style="color:#2196f3">  {{$data->generation}}</span>
                                        @if($data->type=="รถยนต์"||$data->type=="รถจักรยานยนต์")<b>สี: </b><span style="color:#2196f3">  {{$data->color}}</span>
                                        <b>ทะเบียน: </b><span style="color:#2196f3">  {{$data->licenseplate}}</span> @endif </br>
                                        <b>จำนวนเงินต้น: </b><span style="color:#2196f3"> {{ number_format($data->amount, 0) }} </span><span>คิดอัตรา</span><span style="color:#2196f3"> {{$data->percent}}</span> เปอร์เซ็น</br>
                                        <b>เป็นเงิน: </b><span style="color:#2196f3"> {{ number_format($data->interest, 0) }} </span>/ เดือน ล็อค: <span style="color:#2196f3">  {{$data->islock}}</span></br>
                                        
                                    </div>
                                    </div>
                                    <div class="row">
                                            <div class="col-md-12"> @if(count($att)>1)ไฟล์แนบ: @endif
                                                @foreach($att as $item)
                                                <a href="{{asset('attachment/'.$item->path)}}" target="_blank"><button class="btn btn-sm btn-app-cyan-outline" type="button"><i class="ion-android-attach"></i></button></a>
                                                @endforeach
                                            </div>
                                    </div>
                                </div>
                                <!-- .card-block -->
                            </div>
                </div>
                <!-- .col-lg-8 -->
                <!-- End Company overview Chart -->

                <!-- Weekly transactions Widget -->
                <div class="col-lg-4">
                        <!-- Notifications Widget -->
                        <div class="card">
                            <div class="card-header">
                                <h4>ข้อมูลการรับเงิน</h4>
                                <ul class="card-actions">
                                    <li>
                                        <button type="button" data-toggle="card-action" data-action="fullscreen_toggle"><i class="ion-android-expand"></i></button>
                                    </li>
                                    <li>
                                        <button type="button" data-toggle="card-action" data-action="refresh_toggle" data-action-mode="demo"><i class="ion-android-refresh"></i></button>
                                    </li>
                                    <li>
                                        <button type="button" data-toggle="card-action" data-action="content_toggle"><i class="ion-chevron-down"></i></button>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-block">
                                <div class="pull-r-l pull-t m-b">
                                    <table class="card-table text-center bg-gray-lighter-o b-b">
                                        <tbody>
                                            <tr class="row">
                                                @if(Auth::user()->level==0)
                                                <td class="col-xs-6 b-r" data-toggle="modal" data-target="#modal-fromleft">
                                                    <i class="ion-social-usd fa-1-5x fa-3x text-muted"></i>
                                                    <p class="h6 text-muted m-t-0">ชำระล่วงหน้า</p>
                                                </td>
                                                <td class="col-xs-6" data-toggle="modal" data-target="#modal-top">
                                                    <i class="ion-ios-box fa-1-5x fa-3x text-muted"></i>
                                                    <p class="h6 text-muted m-t-0">ประวัติการทำงาน</p>
                                                </td>
                                                @else
                                                <td class="col-xs-12" data-toggle="modal" data-target="#modal-fromleft">
                                                        <i class="ion-social-usd fa-1-5x fa-3x text-muted"></i>
                                                        <p class="h6 text-muted m-t-0">ชำระล่วงหน้า</p>
                                                    </td>
                                                @endif
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <?php $row=1;?>
                                @foreach($transection as $transecitem)
                                    <div data-toggle="modal" data-target="#modal-popout{{$row}}">
                                        @if($transecitem->status==0)
                                            <div class="alert alert-danger alert-dismissable">
                                        @elseif($transecitem->status==1)
                                        <div class="alert alert-warning alert-dismissable">
                                        @elseif($transecitem->status==2)
                                            <div class="alert alert-success alert-dismissable">
                                        @endif
                                        
                                        <p><b>{{date('d/m/Y', strtotime($transecitem->date))}} </b><span style="font-size:12px"><br />โดย:{{$transecitem->name}} วันที่:{{date('d/m/Y', strtotime($transecitem->updated_at))}}<br />
                                        รับเงิน:{{$transecitem->amount}} บันทึก:{{$transecitem->note}}</span></p>
                                    </div>
                                    </div>
                                    <?php $row++;?>
                                @endforeach

                            </div>
                        </div>
                     
                    </div>

            </div>
    </div>

    <?php 
    $rows=1;
    function getfine($day,$type) {
        $fine=0;
        if($type=="โฉนด"){ $fine = 200;}
        elseif($type=="พระ"){$fine = 100;}
        elseif($type=="ปืน"){$fine = 100;}
        elseif($type=="มือถือ"){$fine = 50;}
        elseif($type=="เช็คค้ำ"){$fine = 200;}
        elseif($type=="ปากเปล่า"){$fine = 200;}
        elseif($type=="รถยนต์"){$fine = 200;}
        elseif($type=="รถจักรยานยนต์"){$fine = 100;}

        echo "<span style='color:red'>คิดค่าปรับ ".$day."วันละ ".$fine." เป็นเงิน ".($day*$fine) ."บาท</span>";
    }
    
    ?>
    @foreach($transection as $transecitem)
        <div class="modal fade" id="modal-popout{{$rows}}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-popout">
                        <div class="modal-content">
                            <div class="card-header bg-blue bg-inverse">
                                <h4>แก้ไขข้อมูลการรับเงิน </h4>
                                <ul class="card-actions">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                    </li>
                                </ul>
                            </div><div class="card-block">
                                    <form class="form-horizontal m-t-sm" action="{{ url('/edittransection') }}" method="post" >
                                        @csrf
                                        <div class="form-group has-success">
                                                <div class="col-sm-9">
                                                        <div class="form-material">
                                                        <input type="hidden" value="{{$transecitem->id}}" name="transec_id">
                                                        <input type="hidden" value="{{$data->id}}" name="maindata_Id">
                                                            <input class="form-control" type="hidden" id="date" name="date" value="{{$transecitem->date}}" required readonly>
                                                            {{date('d/m/Y', strtotime($transecitem->date))}}
                                                            <label for="material-success">ของวันที่ </label>
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="form-group has-success">
                                                <div class="col-sm-9">
                                                        <div class="form-material">
                                                            <input class="form-control" type="number" id="amountN" name="amount" value="{{$transecitem->amount}}" min="1" max="{{$data->interest}}" placeholder="โปรดระบุจำนวนเงิน" required>
                                                            <label for="material-success">รับเงิน</label>
                                                            <div class="help-block text-right">ยอดชำระ {{ number_format($data->interest, 0) }} บาท <span style="color:#ffbe0b" id="calculateN"></span>
                                                            
                                                            <?php 
                                                            
                                                            $startcal = date("d-m-Y",strtotime("+3 days",strtotime($transecitem->date)));
                                                            $endcal = date("d-m-Y",strtotime("+1 month",strtotime($transecitem->date))); 
                                                            $dateend= new DateTime($endcal);
                                                            $datestart = new DateTime($startcal);
                                                            $nowdate = new DateTime($datenow);
                                                            
                                                            $difflimit=date_diff($datestart,$dateend);

                                                            $diff=date_diff($datestart,$nowdate);
                                                            //echo $nowdate->format("d-m-Y")."เลยมาแล้ว".$diff->format("%R%a")."ไม่เกิน:". $difflimit->format("%d")."คิดรายวัน".$diff->format("%d");
                                                            //echo "เริ่มคิดวันที่:".$datestart->format("d-m-Y");
                                                            //echo "วันนี้:".$nowdate->format("d-m-Y");
                                                            //echo "เพดานเดือนคือ:".$difflimit->format("%d");
                                                            //echo "เกินมาปัจจุบันคือ:".$diff->format("%R%a");
                                                            //echo $diff->format("%R%a").">=".$difflimit->format("%R%a");
                                                            if($transecitem->status==0){
                                                                if($diff->format("%R%a")>=1){
                                                                    if($diff->format("%a")>=$difflimit->format("%a")){
                                                                        getfine($difflimit->format("%a"),$data->type);
                                                                       
                                                                    }
                                                                    else{
                                                                        getfine($diff->format("%a"),$data->type);
                                                                        //echo " มีค่าปรับ :".($diff->format("%a"));
                                                                    }
                                                                    
                                                                }
                                                            }
                                                            
                                                            //echo $diff->format("%R%a days");?>
                                                            </div>
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="form-group has-success">
                                                <div class="col-sm-9">
                                                        <div class="form-material">
                                                            <input class="form-control" type="text" id="note" name="note" value="{{$transecitem->note}}" placeholder="โปรดใส่ข้อความที่จะบันทึก">
                                                            <label for="material-success">บันทึกข้อความ</label>
                                                            <input type="hidden" value="0" id="statusN" name="status">
                                                        </div>
                                                    </div>
                                        </div>
                                        <div class="col-ms-9" style="padding-left:15px">
                                            <div class="row">
                                               <div class="d" style="display:none"> 
                                                    <label class="css-input css-checkbox css-checkbox-lg css-checkbox-danger disabled">
                                                            <input type="checkbox" checked="" disabled><span></span> ยังไม่จ่าย
                                                        </label>
                                                
                                               </div>
                                               <div class="w" style="display:none">
                                                
                                                        <label class="css-input css-checkbox css-checkbox-lg css-checkbox-warning disabled">
                                                                <input type="checkbox" checked="" disabled><span></span> จ่ายบางส่วน
                                                            </label>
                                               
                                               </div>
                                               <div class="p" style="display:none">
                                                   
                                                            <label class="css-input css-checkbox css-checkbox-lg css-checkbox-primary disabled">
                                                                    <input type="checkbox" checked="" disabled><span></span> จ่ายครบถ้วน
                                                                </label>
                                              
                                                
                                               </div>
                                            </div>
                                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-sm btn-app-blue" type="submit" ><i class="ion-checkmark"></i> บันทึก</button>
                <a href="{{URL::to('deletetransection/'.$transecitem->id)}}" onclick="return confirm('คุณต้องการจะลบใช่หรือไม่?')"><button class="btn btn-sm btn-app-red" type="button">ลบ</button></a>
                </form>
                </div>
                        </div>
                    </div>
                </div>
        <?php $rows++ ;?>
    @endforeach














    <!-- From ชำระเงินล่วงหน้า Modal -->
    <div class="modal fade" id="modal-fromleft" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-fromleft">
                <div class="modal-content">
                    <div class="card-header bg-green bg-inverse">
                        <h4>ชำระเงินล่วงหน้า</h4>
                        <ul class="card-actions">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-block">
                                        <form class="form-horizontal m-t-sm" action="{{ url('/insertTransectionNext') }}" method="post" id="form_next" >
                                            @csrf
                                            <div class="form-group has-success">
                                                    <div class="col-sm-9">
                                                            <div class="form-material">
                                                            <input type="hidden" value="{{$data->id}}" name="maindata_Id">
                                                                <input class="form-control" type="hidden" id="date" name="date" value="{{$datenext}}" required readonly>
                                                                {{date('d/m/Y', strtotime($datenext))}}
                                                                <label for="material-success">ของวันที่ </label>
                                                            </div>
                                                        </div>
                                            </div>
                                            <div class="form-group has-success">
                                                    <div class="col-sm-9">
                                                            <div class="form-material">
                                                                <input class="form-control" type="number" id="amountN" name="amount" value="" min="1" max="{{$data->interest}}" placeholder="โปรดระบุจำนวนเงิน" required>
                                                                <label for="material-success">รับเงิน</label>
                                                                <div class="help-block text-right">ยอดชำระ {{ number_format($data->interest, 2) }} บาท <span style="color:#ffbe0b" id="calculateN"></span> </div>
                                                            </div>
                                                        </div>
                                            </div>
                                            <div class="form-group has-success">
                                                    <div class="col-sm-9">
                                                            <div class="form-material">
                                                                <input class="form-control" type="text" id="note" name="note" value="" placeholder="โปรดใส่ข้อความที่จะบันทึก">
                                                                <label for="material-success">บันทึกข้อความ</label>
                                                                <input type="hidden" value="0" id="statusN" name="status">
                                                            </div>
                                                        </div>
                                            </div>
                                            <div class="col-ms-9" style="padding-left:15px">
                                                <div class="row">
                                                   <div class="d" style="display:none"> 
                                                        <label class="css-input css-checkbox css-checkbox-lg css-checkbox-danger disabled">
                                                                <input type="checkbox" checked="" disabled><span></span> ยังไม่จ่าย
                                                            </label>
                                                    
                                                   </div>
                                                   <div class="w" style="display:none">
                                                    
                                                            <label class="css-input css-checkbox css-checkbox-lg css-checkbox-warning disabled">
                                                                    <input type="checkbox" checked="" disabled><span></span> จ่ายบางส่วน
                                                                </label>
                                                   
                                                   </div>
                                                   <div class="p" style="display:none">
                                                       
                                                                <label class="css-input css-checkbox css-checkbox-lg css-checkbox-primary disabled">
                                                                        <input type="checkbox" checked="" disabled><span></span> จ่ายครบถ้วน
                                                                    </label>
                                                  
                                                    
                                                   </div>
                                                </div>
                                            </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">ปิด</button>
                        <button class="btn btn-sm btn-app" type="submit" id="next_submit"><i class="ion-checkmark"></i> บันทึก</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End From Left Modal -->

       <!-- ดูประวัติการทำงาน Modal -->
       <div class="modal fade" id="modal-top" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <div class="card-header bg-green bg-inverse">
                        <h4>ประวัติการทำงาน</h4>
                        <ul class="card-actions">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-block">
                        @foreach($history as $hislist)
                        @if($hislist->action=="Create Transection"||$hislist->action=="Edit Transection"||$hislist->action=="Delete Transection")
                        <div class="alert alert-warning alert-dismissable">
                        @else
                        <div class="alert alert-info alert-dismissable">
                        @endif
                                    <p><b>{{$hislist->created_at}} </b><span style="font-size:12px"><br />โดย:{{$hislist->name}}<br />
                                        {{$hislist->action}}<br />
                                    {!!$hislist->note!!}</span></p>
                            </div>
                        @endforeach
                        <!--<div class="alert alert-success alert-dismissable">
                                        <p><b>28/10/2018 </b><span style="font-size:12px"><br />โดย:ผู้ใหญ่ลี ตีกลองประชุม<br />
                                            รับชำระเงินครบถ้วน</span></p>
                                </div>
                                <div class="alert alert-warning alert-dismissable">
                                        <p><b>28/11/2018 </b><span style="font-size:12px"><br />โดย:สมสมัน มานะยิ่ง<br />
                                            บันทึก:จ่ายก่อน 500 บาท</span></p>
                                </div>
                                <div class="alert alert-danger alert-dismissable">
                                        <p><b>28/12/2018 </b><span style="font-size:12px"><br />โดย:ผู้ใหญ่ลี ตีกลองประชุม <br />
                                            บันทึก:ยังไม่ชำระเงิน</span></p>
                                </div>
                                <div class="alert alert-info alert-dismissable">
                                        <p><b>28/12/2018 </b><span style="font-size:12px"><br />โดย:ผู้ใหญ่ลี ตีกลองประชุม <br />
                                            บันทึก:เดิมเปอร์เซ็น 10% เป็น 7% <br />
                                            บันทึก:เดิมยอดเงิน 1000000 เป็น 50000</span></p>
                                </div> -->
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Close</button>
                        <button class="btn btn-sm btn-app" type="button" data-dismiss="modal"><i class="ion-checkmark"></i> Ok</button>
                    </div>
                </div>
            </div>
        </div>
        

<div class="modal fade" id="modal-slideleft" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-slideleft">
                            <div class="modal-content">
                                <div class="card-header bg-blue bg-inverse">
                                    <h4>แก้ไขข้อมูล</h4>
                                    <ul class="card-actions">
                                        <li>
                                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-block">
                                        <form method="POST" action="{{ url('/editmaindata') }}" accept-charset="UTF-8" class="form-horizontal m-t-xs" enctype="multipart/form-data">

                                            @csrf
                                            <div class="form-group">
                                                    <div class="col-xs-12">
                                                            <label class="css-input css-radio css-radio-lg css-radio-primary m-r-sm">
                                                                <input type="radio" name="status" value="1" {{$data->status==1?'checked=""':''}}><span></span> เปิดบัญชี
                                                            </label>
                                                            <label class="css-input css-radio css-radio-lg css-radio-danger">
                                                                <input type="radio" name="status" value="0" {{$data->status==0?'checked=""':''}}><span></span> ปิดบัญชี
                                                            </label>
                                                    </div>
                                            </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label for="validation-classic-NameTH">รหัส</label>
                                                <div>
                                                <input type="hidden" name="id" value="{{$data->id}}">
                                                <input class="form-control code" type="text" value="{{$data->code}}" autocomplete="off" id="code" name="code" required="required" placeholder="กรุณากรอกรหัส" onchange="checkcode(this.value)">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <label  for="validation-classic-NameTH">วันที่</label>
                                                <div >
                                                <input class="form-control" type="date" id="date" name="date" value="{{$data->date}}" required="required" placeholder="กรุณาระบุวันที่">
                                                </div>
                                        </div>
                                        </div>    
                                        
                                        <div class="form-group">
                                                <label class="col-xs-12" for="validation-classic-NameTH">ชื่อ</label>
                                                <div class="col-xs-12">
                                                    <input class="form-control" type="text" value="{{$data->name}}" id="name" name="name" required="required" placeholder="กรุณากรอกชื่อ">
                                                </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-xs-12" for="validation-classic-NameEN">เบอร์โทรศัพท์</label>
                                            <div class="col-xs-12">
                                                <input class="form-control" type="number" value="{{$data->tel}}" id="tel" name="tel" required="required" placeholder="กรุณากรอกเบอร์โทร">
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <div class="col-xs-12">
                                                        <label for="validation-classic-BlogType">ประเภท</label>
                                                        <select class="form-control" name="type" id="typech" required >
                                                            <option value="">--เลือกประเภท--</option> 
                                                            <option value="โฉนด" {{$data->type=="โฉนด"?'selected="selected"':''}}>โฉนด</option>  
                                                            <option value="พระ" {{$data->type=="พระ"?'selected="selected"':''}}>พระ</option>  
                                                            <option value="ปืน" {{$data->type=="ปืน"?'selected="selected"':''}}>ปืน</option>  
                                                            <option value="มือถือ" {{$data->type=="มือถือ"?'selected="selected"':''}}>มือถือ</option>  
                                                            <option value="เช็คค้ำ" {{$data->type=="เช็คค้ำ"?'selected="selected"':''}}>เช็คค้ำ</option>  
                                                            <option value="ปากเปล่า" {{$data->type=="ปากเปล่า"?'selected="selected"':''}}>ปากเปล่า</option>  
                                                            <option value="รถยนต์" {{$data->type=="รถยนต์"?'selected="selected"':''}}>รถยนต์</option>   
                                                            <option value="รถจักรยานยนต์" {{$data->type=="รถจักรยานยนต์"?'selected="selected"':''}}>รถจักรยานยนต์</option>               
                                                            </select>
     
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                    <div class="col-xs-12">
                                                        <label for="validation-classic-BlogType">รายละเอียด</label>
                                                    <input class="form-control" type="text" value="{{$data->description}}" id="description" name="description" required="required" placeholder="กรุณากรอกรายละเอียด">
                                                    </div>
                                                </div>
                                                <div class="col-xs-4">
                                                        <div class="form-group">
                                                            <label for="validation-classic-NameTH">ยี่ห้อ/รุ่น</label>
                                                            <div>
                                                            <input class="form-control" type="text" value="{{$data->generation}}" id="generation" name="generation" required="required" placeholder="ระบุยี่ห้อ/รุ่น">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row"  style="padding-left: 15px; padding-right: 15px;">  
                                                    <div class="col-xs-4">
                                                            <div class="form-group" id="hcolor">
                                                                <label for="validation-classic-NameTH">สี</label>
                                                                <div>
                                                                <input class="form-control" type="text" value="{{$data->color}}" id="color" name="color"  placeholder="ระบุสี">
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="col-xs-4">
                                                                <div class="form-group" id="hpay">
                                                                    <label for="validation-classic-NameTH">ป้ายทะเบียน</label>
                                                                    <div>
                                                                        <input class="form-control" type="text" value="{{$data->licenseplate}}" id="licenseplate" name="licenseplate"  placeholder="ระบุป้ายทะเบียน">
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                    </div>       
                                                <div class="col-xs-6">
                                                        <div class="form-group">
                                                            <label for="validation-classic-NameTH">ยอดเงิน</label>
                                                            <div>
                                                            <input class="form-control" type="number" value="{{$data->amount}}" id="amount" name="amount" required="required" placeholder="ระบุจำนวนเงิน" onchange="cal()">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-3">
                                                        <div class="form-group">
                                                            <div >
                                                                    <label for="validation-classic-BlogType">คิด %</label>
                                                                            <select class="form-control" name="percent" id="percent" onchange="cal()" required>
                                                                            <option value="{{$data->percent}}">{{$data->percent}}%</option>
                                                                                    <option value="0.5">0.5%</option>   
                                                                                    <option value="1">1%</option>  
                                                                                    <option value="1.5">1.5%</option>   
                                                                                    <option value="2">2%</option> 
                                                                                    <option value="2.5">2.5%</option> 
                                                                                    <option value="3">3%</option> 
                                                                                    <option value="3.5">3.5%</option> 
                                                                                    <option value="4">4%</option> 
                                                                                    <option value="4.5">4.5%</option> 
                                                                                    <option value="5">5%</option> 
                                                                                    <option value="5.5">5.5%</option> 
                                                                                    <option value="6">6%</option> 
                                                                                    <option value="6.5">6.5%</option> 
                                                                                    <option value="7">7%</option> 
                                                                                    <option value="7.5">7.5%</option> 
                                                                                    <option value="8">8%</option>
                                                                                    <option value="8.5">8.5%</option> 
                                                                                    <option value="9">9%</option> 
                                                                                    <option value="9.5">9.5%</option> 
                                                                                    <option value="10">10%</option>        
                                                                                </select>          
                                                                   
                                                            </div>
                                                    </div>
                                                </div> 
                                                <div class="col-xs-3">
                                                    <div class="form-group">
                                                        <label for="validation-classic-NameTH">ล็อค</label>
                                                        <div>
                                                            <input class="form-control" type="text" value="{{$data->islock}}" id="islock" name="islock" required="required" placeholder="ระบุล็อค" >
                                                        </div>
                                                    </div>
                                                
                                            </div>   
                                                <div class="form-group">
                                                        <div class="col-xs-12">
                                                            <label for="validation-classic-BlogType">คำนวณ/เดือน</label>
                                                        <input class="form-control" type="text" value="{{$data->interest}}" readonly id="interest" name="interest" required="required" placeholder="ระบบคำนวณอัตโนมัติ">
                                                        </div>
                                                    </div>
                                        <div class="form-group">
                                            <label class="col-xs-12" for="Image">รูปภาพ</label>
                                            <div class="col-xs-12">
                                            <input type="file" id="image" class="form-control" name="image">
                                            <img class="img-responsive" id="imgpreview" width="250" src="" alt="" style="display:none;">
                                            </div>
                                        </div>
                                        
                                        
                                
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">ปิด</button>
                                    <button class="btn btn-sm btn-app-blue" type="submit" id="btaddmain"><i class="ion-checkmark"></i> บันทึก</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
     <script>
         $('#next_submit').click(function(){
            $('#next_submit').attr("disabled", true);
            $("#form_next").submit();
         });
    function checkcode(code){
            $.ajax({
            url: "{{url('checkdupcode')}}"+"/"+code,
            cache: false,
            success: function(html){
                    if(html==1){
                        $('.code').css("color","red");
                        alert('แจ้งเตื่อน: รหัสนี้ถูกใช้งานไปแล้ว!');
                        $('#btaddmain').hide();

                    }
                    else{
                        $('.code').css("color","black");
                        $('#btaddmain').show();
                    }
                }
            });
        }
                            var classnumber = 0;
                            function readURL(input) {
                            
                              if (input.files && input.files[0]) {
                                var reader = new FileReader();
                            
                                reader.onload = function(e) {
                                  $('#imgpreview').show();
                                  $('#imgpreview').attr('src', e.target.result);
                                }
                            
                                reader.readAsDataURL(input.files[0]);
                              }
                            }
                            $("#typech").change(function(){
                                if($( "#typech option:selected" ).val()=='รถยนต์'||$( "#typech option:selected" ).val()=='รถจักรยานยนต์'){
                                    $( "#hcolor" ).show();
                                    $( "#hpay" ).show();
                                }
                                else{
                                    $( "#hcolor" ).hide();
                                    $( "#hpay" ).hide();
                                }
                            });
                            $("#image").change(function() {
                              readURL(this);
                            });
                        
                            function cal(){
                                var amount = $('#amount').val();
                                var percent = $('#percent option:selected').val();
                                $('#interest').val(amount*percent/100);
                            }
                        
                            function addatt(){
                                
                                var inputs = $("#addatt").find($("input") );
                                $('#addatt').append('<div class="attid'+classnumber+'"><div class="col-xs-10"><input type="file" id="att" class="form-control" name="attachment[]" required></div><div class="col-xs-1"><i class="fa fa-times-circle" style="color:#ff9800;font-size:35px" onclick="removeatt('+classnumber+')"></i></div></div>');
                                classnumber=classnumber+1;
                            }
                        
                            function removeatt(id){
                                $('.attid'+id).remove();
                            }

                            if($( "#typech option:selected" ).val()=='รถยนต์'||$( "#typech option:selected" ).val()=='รถจักรยานยนต์'){
                                    $( "#hcolor" ).show();
                                    $( "#hpay" ).show();
                                }
                                else{
                                    $( "#hcolor" ).hide();
                                    $( "#hpay" ).hide();
                                }
                        </script>
                       
@endsection
