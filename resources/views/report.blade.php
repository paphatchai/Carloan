@extends('layouts.dashboard')

@section('content')
<style>
  
    @media print {
        body * {
            visibility: hidden;
        }
        #section-to-print, #section-to-print * {
            visibility: visible;
            -webkit-print-color-adjust:exact;
        }
        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
            -webkit-print-color-adjust: exact;
        }
        .red{
            color:red !important;
            -webkit-print-color-adjust:exact;
        }
        .green{
            color:green !important;
            -webkit-print-color-adjust:exact;
        }
    }
</style>
<!-- Page Content -->
<div class="container-fluid p-y-md">
    <!-- Stats -->
    <div class="col-lg-12">
            <div class="card">
                    <div class="card-header bg-blue bg-inverse">
                    <div class="h4">รายงานผล</div>
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
                        <div class="form-group" >
                            <form method="GET" action="{{ url('/report') }}" accept-charset="UTF-8" class="form-horizontal m-t-xs" enctype="multipart/form-data">
                                <div class="row">
                                            @csrf
                                <div class="col-sm-3" style="padding-top: 15px;">
                                    <div class="form-material">
                                        <label for="validation-classic-BlogType">วันที่เริ่ม</label>
                                        <input type="date" class="form-control" name="datestart" style="background-color:#e7eef5" value="<?php echo (isset($_GET['datestart']))? $_GET['datestart'] : "" ?>" required>
                                    </div>
                                        
                                </div>
                                <div class="col-sm-3" style="padding-top: 15px;">
                                    <div class="form-material">
                                        <label for="validation-classic-BlogType">วันที่สิ้นสุด</label>
                                        <input type="date" class="form-control" name="dateend" style="background-color:#e7eef5" require value="<?php echo (isset($_GET['dateend']))? $_GET['dateend'] : "" ?>" required>
                                    </div>
                                        
                                </div>
                                <div class="col-sm-2"  style="padding-top: 15px;">
                                    <div class="form-material">
                                        <label for="validation-classic-BlogType">กรองจาก</label>
                                    <select class="form-control" name="status" id="status" style="background-color:#e7eef5">
                                        
                                        <option value="all">--ทั้งหมด--</option> 
                                        <option value="N" <?php echo (isset($_GET['status']))&&$_GET['status']=="N"? "selected" : "" ?>>ค้างชำระ</option>  
                                        <option value="Y" <?php echo (isset($_GET['status']))&&$_GET['status']=="Y"? "selected" : "" ?>>ชำระแล้ว</option>  
                                           
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4"  style="padding-top: 15px;">
                                    <div class="form-material">
                                        <input type="submit" value="ค้นหา" class="btn btn-app-blue">
                                        
                                        <input type="button" value="ปริ้น" class="btn btn-app-blue" onclick = "window.print()">
                                    </div>
                                </div>
                                </div>
                                </form>
                            </div>
                        <div class="pull-r-l mobile-hide"  id="section-to-print">
                                
                            <table class="js-table-checkable table table-hover table-vcenter m-b-0">
                                <tbody>
                                <tr>
                                    <td class="text-center"></td>
                                    <td class="font-500">รหัส</td>
                                    <td class="font-500">วันที่</td>
                                    <td class="font-500">ชื่อ</td>
                                    <td class="font-500"> ประเภท </td>
                                    <td class="font-500" style="text-align: right;">ยอดชำระ</td>
                                </tr>
                                <?php 
                                    $num = 1;
                                    $totalOwed = 0;
                                    $totalReceived = 0;
                                ?>
                                @foreach ($data as $item)
                                
                                <tr onclick="location.href='{{ url('/detail/'.$item->id) }}'">
                                    <td class="">
                                        <label class="css-input css-checkbox css-checkbox-default">
                                        <span>{{$num}}</span>
                                        </label>
                                    </td>
                                    <td class="font-300">{{$item->code}}</td>
                                    <td class="font-300">{{date('d/m/Y', strtotime($item->date))}}</td>
                                    <td class="font-300">{{$item->name}}</td>
                                    <td>{{$item->type}}
                                    </td>
                                    @if($item->status==2)
                                    <td class="" style="text-align: right;"><div class=""><span class="green" style="color:green">{{ number_format($item->amount, 0) }}<?php $totalReceived+=$item->amount ?></span></div></td>
                                    @elseif($item->status==0)
                                    <td class="" style="text-align: right;"><div class="" ><span class="red" style="color:red">{{ number_format($item->interest, 0) }}<?php $totalOwed+=$item->interest ?></span></div></td>
                                    @else
                                    <td class="" style="text-align: right;"><div class="" >
                                        @if($_GET['status']=="all"||$_GET['status']=="Y")<span class="green" style="color:green">{{ number_format($item->amount, 0) }}<?php $totalReceived+=$item->amount ?></span><br />@endif
                                        @if($_GET['status']=="all"||$_GET['status']=="N")<span class="red" style="color:red">{{ number_format($item->interest - $item->amount, 0) }}<?php $totalOwed+=$item->interest - $item->amount ?></span></div>@endif
                                    </td>
                                    @endif
                                </tr>
                                <?php $num ++;?>
                                @endforeach  
                                                 
                                </tbody>
                            </table>
                            <div>
                            <p style="text-align: right;">
                            @if(isset($_GET['status']))
                                @if($_GET['status']=="all"||$_GET['status']=="N")สรุปยอดค้างชำระ : <b class="red" style="color:red">{{ number_format($totalOwed, 0) }}</b> บาท<br/> @endif
                                @if($_GET['status']=="all"||$_GET['status']=="Y")สรุปยอดชำระแล้ว : <b class="green" style="color:green">{{ number_format($totalReceived, 0) }} </b>บาท @endif
                            @endif
                            </p>
                            </div>
                        </div>

    <?php $nums = 1;?>
       
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
