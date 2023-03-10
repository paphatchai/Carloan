@extends('layouts.dashboard')

@section('content')
<style>
        @media screen and (max-width: 700px) {
      .mobile-hide {
        display: none !important;
      }
      .mobile-show {
        display: block !important;
      }
    }
        </style>
<!-- Page Content -->
<div class="container-fluid p-y-md">
    <!-- Stats -->
    <div class="col-lg-12">
            <div class="card">
                    <div class="card-header bg-blue bg-inverse">
                        <div class="h4">ข้อมูล</div>
                        <ul class="card-actions">
                            <li>
                                <button type="button" data-toggle="card-action" data-action="refresh_toggle" data-action-mode="demo"><i class="ion-refresh"></i></button>
                            </li>
                            <li>
                                <button type="button" data-toggle="card-action" data-action="fullscreen_toggle"><i class="ion-android-expand"></i></button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-block" style="padding-top:0px">
                        <!-- Messages & Checkable Table (.js-table-checkable class is initialized in App() -> uiHelperTableToolsCheckable()) -->
                        <div class="form-group">
                                <div class="col-sm-4">
                                    <div class="form-material">
                                        <select class="form-control" id="find" name="material-select" size="1" style="background-color:#e7eef5">
                                                <?php echo (isset($_GET['type']) ? "<option value='".$_GET['type']."'>".$_GET['type']."</option> " : '') ?>
                                                <option value="All">ทั้งหมด</option> 
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
                                <div class="col-sm-8">
                                        <div class="form-material" id="showcount">
                                        </div>
                                </div>
                            </div>
                        <div class="pull-r-l mobile-hide">
                                
                            <table class="js-table-checkable table table-hover table-vcenter m-b-0">
                                <tbody>
                                <tr>
                                    <td class="hidden-xs text-center"></td>
                                    <td class="font-300">ภาพถ่าย</td>
                                    <td class="hidden-xs font-500">รหัส</td>
                                    <td class="font-500">วันที่</td>
                                    <td class="font-500">ชื่อ</td>
                                    <td class="hidden-xs font-500"> ประเภท </td>
                                    <td class="hidden-xs font-500">ยอดชำระ</td>
                                    <td class="hidden-xs font-500"></td>
                                </tr>
                                <?php $num = 1;?>
                                @foreach ($data as $item)
                                
                                <tr style="{{$item->status==0?'color:red;':''}}" >
                                    <td class="hidden-xs text-center" onclick="location.href='{{ url('/detail/'.$item->id) }}'">
                                        <label class="css-input css-checkbox css-checkbox-default">
                                        <span>{{$num}}</span>
                                        </label>
                                    </td>
                                    <td class="font-200" onclick="location.href='{{ url('/detail/'.$item->id) }}'"><img src="{{asset('images/'.$item->image)}}" width="180px" height="100px"></td>
                                    <td class="font-300" onclick="location.href='{{ url('/detail/'.$item->id) }}'">{{$item->code}}</td>
                                    <td class="font-300" onclick="location.href='{{ url('/detail/'.$item->id) }}'">{{date('d/m/Y', strtotime($item->date))}}</td>
                                    <td class="font-300" onclick="location.href='{{ url('/detail/'.$item->id) }}'">{{$item->name}}</td>
                                    <td onclick="location.href='{{ url('/detail/'.$item->id) }}'">
                                        <div class="hidden-xs text-muted">                                                                                                                                                                                                                                                                                                                                                                                                   
                                                {{$item->type}}                                                                                                                                               
                                        </div>
                                    </td>
                                    <td class="text-muted" onclick="location.href='{{ url('/detail/'.$item->id) }}'"><div class="text-muted">{{ number_format($item->interest, 0) }}</div></td>
                                    <td style="width:50px">
                                    @if(!Auth::check())
                           
                                    @else
                                        @if(Auth::user()->level==0)
                                            <a href="{{ url('/delete/'.$item->id) }}"  onclick="return confirm('คุณแน่ใจหรือไม่ที่จะลบข้อมูลนี้ออกจากระบบ?')">
                                                <input type="button" value="ลบ" class="btn btn-app-red" >
                                            </a>
                                        @endif
                                    @endif
                                    </td>
                                </tr>
                                <?php $num ++;?>
                                @endforeach                          
                                </tbody>
                            </table>
                        </div>

    <?php $nums = 1;?>
    @foreach ($data as $itemM)
    <div class="col-lg-6 mobile-show"  style="display:none;{{$itemM->status==0?'color:red;':''}}" onclick="location.href='{{ url('/detail/'.$itemM->id) }}'">
            <div class="card">
                    <div class="card-block">
                            <img class="img-responsive" src="{{asset('images/'.$itemM->image)}}" alt="">
                    <p style="padding-top:20px">ชื่อ: {{$itemM->name}}<br />
                            วันที่:{{date('d/m/Y', strtotime($itemM->date))}}<br />
                            รหัส: {{$itemM->code}} <br />
                            ประเภท: {{$itemM->type}}<br />
                            ยอดชำระ: {{ number_format($itemM->interest, 0) }}<br /></p>
                    </div>
                </div>
           
        </div>
    <!-- .row -->
    <?php $nums ++;?>
    @endforeach     
                        <!-- End Messages -->
                        <div style="width: 100%;    overflow-x: auto;    white-space: nowrap;"> {{ $data->appends(request()->input())->onEachSide(1)->links() }} </div>
                    </div>
                    </div>
                    <!-- .card-block -->
                </div>
    </div>
    <!-- .row -->
    <!-- End stats -->

    
    <!-- .row -->
</div>
<script>

    $("#find").change(function(){
        window.location.href = "{{url('listing')}}"+"?type="+$( "#find option:selected" ).val()+"&keyword="+$( "#find option:selected" ).val();
        //url: "{{url('listing')}}"+"?type="+$( "#find option:selected" ).val(),        
    });
    
           $.ajax({url: "{{url('countdata')}}"+"/<?php echo (isset($_GET['type']) ? $_GET['type'] : 'All') ?>",
            cache: false,
            success: function(html){
                    $('#showcount').html(html);  
                }
            });
       
        
       
</script>
@endsection
