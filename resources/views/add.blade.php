@extends('layouts.dashboard')

@section('content')
<div class="loading" style="display:none">
    <img src="{{asset('image/Spin-1s-200px.gif')}}" style="position: absolute;
    top: 50%;
    left: 50%;
    z-index: 100;">
</div>
<!-- Page Content -->
 <!-- Page Content -->
 <div class="container-fluid p-y-md">
    <div class="row">
    
        <!-- .col-sm-5 -->
        <div class="col-sm-12 col-lg-2"></div>
        <div class="col-sm-12 col-lg-8">
            <!-- Message List -->
            <div class="card">
                <div class="card-header bg-green bg-inverse">
                    <div class="h4">เพิ่มข้อมูล</div>                    
                </div>
                <div class="card-block">
               <!--     <form class="form-horizontal m-t-xs" action="http://u715713640.hostingerapp.com/public/blogs/store" method="post"> -->
                         <form method="POST" action="{{ url('/insert') }}" accept-charset="UTF-8" class="form-horizontal m-t-xs" enctype="multipart/form-data" onsubmit="$('.loading').show()">

                            @csrf
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="validation-classic-NameTH">รหัส</label>
                                <div>
                                    <input class="form-control code" type="text" value="" id="code" name="code" required="required" autocomplete="off" placeholder="กรุณากรอกรหัส" onchange="checkcode(this.value)">
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label  for="validation-classic-NameTH">วันที่</label>
                                <div >
                                    <input class="form-control" type="date" id="date" name="date" required="required" placeholder="กรุณาระบุวันที่">
                                </div>
                        </div>
                        </div>    
                        
                        <div class="form-group">
                                <label class="col-xs-12" for="validation-classic-NameTH">ชื่อ</label>
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" value="" id="name" name="name" required="required" placeholder="กรุณากรอกชื่อ">
                                </div>
                        </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="validation-classic-NameEN">เบอร์โทรศัพท์</label>
                            <div class="col-xs-12">
                                <input class="form-control" type="number" value="" id="tel" name="tel" required="required" placeholder="กรุณากรอกเบอร์โทร">
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label for="validation-classic-BlogType">ประเภท</label>
                                    <select class="form-control" name="type" id="typech" required >
                                        <option value="">--เลือกประเภท--</option> 
                                        <option value="โฉนด">โฉนด</option>  
                                        <option value="พระ">พระ</option>  
                                        <option value="ปืน">ปืน</option>  
                                        <option value="มือถือ">มือถือ</option>  
                                        <option value="เช็คค้ำ">เช็คค้ำ</option>  
                                        <option value="ปากเปล่า">ปากเปล่า</option>  
                                        <option value="รถยนต์">รถยนต์</option>   
                                        <option value="รถจักรยานยนต์">รถจักรยานยนต์</option>           
                                        </select>
                                </div>
                            </div>
                            <div class="form-group">
                                    <div class="col-xs-12">
                                        <label for="validation-classic-BlogType">รายละเอียด</label>
                                        <input class="form-control" type="text" value="" id="description" name="description" required="required" placeholder="กรุณากรอกรายละเอียด">
                                    </div>
                                </div>
                                <div class="row" style="padding-left: 15px; padding-right: 15px;">
                                <div class="col-xs-4">
                                        <div class="form-group">
                                            <label for="validation-classic-NameTH">ยี่ห้อ/รุ่น</label>
                                            <div>
                                                <input class="form-control" type="text" value="" id="generation" name="generation" required="required" placeholder="ระบุยี่ห้อ/รุ่น">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4">
                                            <div class="form-group">
                                                <div id="hcolor">
                                                <label for="validation-classic-NameTH">สี</label>
                                                <div>
                                                    <input class="form-control" type="text" value="" id="color" name="color" placeholder="ระบุสี">
                                                </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-xs-4" >
                                                <div class="form-group">
                                                <div id="hpay">
                                                    <label for="validation-classic-NameTH">ป้ายทะเบียน</label>
                                                    <div>
                                                        <input class="form-control" type="text" value="" id="licenseplate" name="licenseplate" placeholder="ระบุป้ายทะเบียน">
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                <div class="row"  style="padding-left: 15px; padding-right: 15px;">            
                                <div class="col-xs-6">
                                        <div class="form-group">
                                            <label for="validation-classic-NameTH">ยอดเงิน</label>
                                            <div>
                                                <input class="form-control" type="number" value="" id="amount" name="amount" required="required" placeholder="ระบุจำนวนเงิน" onchange="cal()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <div >
                                                    <label for="validation-classic-BlogType">คิด %</label>
                                                    <select class="form-control" name="percent" id="percent" onchange="cal()" required>
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
                                                <input class="form-control" type="text" value="" id="islock" name="islock" required="required" placeholder="ระบุล็อค" >
                                            </div>
                                        </div>
                                    
                                </div>  
                                </div>
                                <div class="form-group">
                                        <div class="col-xs-12">
                                            <label for="validation-classic-BlogType">คำนวณ/เดือน</label>
                                            <input class="form-control" type="text" value="" readonly id="interest" name="interest" required="required" placeholder="ระบบคำนวณอัตโนมัติ">
                                        </div>
                                    </div>
                        <div class="form-group">
                            <label class="col-xs-12" for="Image">รูปภาพ</label>
                            <div class="col-xs-12">
                            <input type="file" id="image" class="form-control" name="image" required>
                            <img class="img-responsive" id="imgpreview" width="250" src="" alt="" style="display:none;">
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="col-xs-12" for="Attachment">แนบไฟล์ <ul class="card-actions">
                                        <li>
                                                <span class="label bg-blue" onclick="addatt()">เพิ่มไฟล์แนบ <i class="fa fa-plus-circle"></i></span>
                                        </li>
                                    </ul></label>
                                <div class="col-xs-12">
                                    <div id="addatt"></div>
                                </div>
                            </div>
                        <div class="form-group m-b-0">
                            <div class="col-xs-12">
                                <button class="btn btn-app-green" id="btaddmain" type="submit">บันทึก</button>
                            </div>
                        </div>
                </form>
                    <!--</form>-->
                </div>
                <!-- .card-block -->
            </div>
            <!-- .card -->
            <!-- End Message List -->
        </div>
        <div class="col-sm-12 col-lg-2"></div>
        <!-- .col-sm-7 -->
    </div>
    <!-- .row -->
</div>
<!-- .container-fluid -->
<!-- End Page Content -->
<script>
  
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
</script>
@endsection
