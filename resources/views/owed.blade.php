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
                    <div class="h4">ข้อมูลยอดค้างชำระ</div>
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
                            <form method="GET" action="{{ url('/owed') }}" accept-charset="UTF-8" class="form-horizontal m-t-xs" enctype="multipart/form-data">
                                <div class="row">
                                            @csrf
                                <div class="col-sm-4" style="padding-top: 15px;">
                                    <div class="form-material">
                                        <label for="validation-classic-BlogType">ระบุวันที่</label>
                                        <input type="date" class="form-control" name="date" style="background-color:#e7eef5" value="<?php echo (isset($_GET['date']))? $_GET['date'] : "" ?>">
                                    </div>
                                        
                                </div>
                                <div class="col-sm-4"  style="padding-top: 15px;">
                                    <div class="form-material">
                                        <label for="validation-classic-BlogType">แสดง</label>
                                    <select class="form-control" name="status" id="status" style="background-color:#e7eef5">
                                        
                                        <option value="">--ทั้งหมด--</option> 
                                        <option value="0" <?php echo (isset($_GET['status']))&&$_GET['status']=="0"? "selected" : "" ?>>ที่ยังไม่จ่าย (แดง)</option>  
                                        <option value="1" <?php echo (isset($_GET['status']))&&$_GET['status']=="1"? "selected" : "" ?>>จ่ายแล้วบางส่วน (เหลือง)</option>  
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4"  style="padding-top: 15px;">
                                    <div class="form-material">
                                        <input type="submit" value="ค้นหา" class="btn btn-app-blue">
                                    </div>
                                </div>
                                </div>
                                </form>
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
                                </tr>
                                <?php $num = 1;?>
                                @foreach ($data as $item)
                                
                                <tr onclick="location.href='{{ url('/detail/'.$item->id) }}'">
                                    <td class="hidden-xs text-center">
                                        <label class="css-input css-checkbox css-checkbox-default">
                                        <span>{{$num}}</span>
                                        </label>
                                    </td>
                                    <td class="font-200"><img src="{{asset('images/'.$item->image)}}" width="180px" height="100px" style="border: 5px solid <?php echo $item->status==1?"#ffeb3b":"#f44336" ?>;
                                        border-radius: 5px;"></td>
                                    <td class="font-300">{{$item->code}}</td>
                                    <td class="font-300">{{date('d/m/Y', strtotime($item->date))}}</td>
                                    <td class="font-300">{{$item->name}}</td>
                                    <td>
                                        <div class="hidden-xs text-muted">                                                                                                                                                                                                                                                                                                                                                                                                   
                                                {{$item->type}}                                                                                                                                               
                                        </div>
                                    </td>
                                    <td class="text-muted"><div class="text-muted" >{{ number_format($item->interest, 0) }}</div></td>
                                    
                                </tr>
                                <?php $num ++;?>
                                @endforeach                          
                                </tbody>
                            </table>
                        </div>

    <?php $nums = 1;?>
    @foreach ($data as $itemM)
    <div class="col-lg-6 mobile-show"  style="display:none;" onclick="location.href='{{ url('/detail/'.$itemM->id) }}'">
            <div class="card">
                    <div class="card-block">
                            <img class="img-responsive" src="{{asset('images/'.$itemM->image)}}" alt="" style="border: 5px solid <?php echo $item->status==1?"#ffeb3b":"#f44336" ?>;
                            border-radius: 5px;" >
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

        
       
</script>
@endsection
