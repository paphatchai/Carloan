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
    <div class="row">
        <div class="col-sm-6 col-lg-3">
            <a class="card" href="javascript:void(0)">
                <div class="card-block clearfix">
                    <div class="pull-right">
                        <p class="h6 text-muted m-t-0 m-b-xs">แจ้งเตือน</p>
                        <p class="h3 text-blue m-t-sm m-b-0">{{count($datamain)}}</p>
                    </div>
                    <div class="pull-left m-r">
                        <span class="img-avatar img-avatar-48 bg-blue bg-inverse" style="background-color:#ffc107"><i class="ion-ios-bell fa-1-5x"></i></span>
                    </div>
                </div>
            </a>
        </div>

        <!-- .col-sm-6 -->

        <div class="col-sm-6 col-lg-3">
                <a class="card bg-blue bg-inverse" href="{{ url('/listing') }}">
                    <div class="card-block clearfix">
                        <div class="pull-right">
                            <p class="h6 text-muted m-t-0 m-b-xs">ข้อมูลทั้งหมด</p>
                            <p class="h3 m-t-sm m-b-0">{{$countdata}}</p>
                        </div>
                        <div class="pull-left m-r">
                            <span class="img-avatar img-avatar-48 bg-gray-light-o"><i class="fa fa-book fa-1-5x"></i></span>
                        </div>
                    </div>
                </a>
            </div>
        <!-- .col-sm-6 -->

        <div class="col-sm-6 col-lg-3">
            <a class="card bg-green bg-inverse" href="{{ url('/add') }}">
                <div class="card-block clearfix">
                    <div class="pull-right">
                        <p class="h6 text-muted m-t-0 m-b-xs">เพิ่มข้อมูล</p>
                        <p class="h3 m-t-sm m-b-0">Add New</p>
                    </div>
                    <div class="pull-left m-r">
                        <span class="img-avatar img-avatar-48 bg-gray-light-o"><i class="ion-android-add fa-1-5x"></i></span>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- .col-sm-6 -->

        <div class="col-sm-6 col-lg-3">
            <a class="card bg-purple bg-inverse" href="{{ url('/logout') }}" style="background-color:#f44336">
                <div class="card-block clearfix">
                    <div class="pull-right">
                        <p class="h6 text-muted m-t-0 m-b-xs">ออกจากระบบ</p>
                        <p class="h3 m-t-sm m-b-0">Logout</p>
                    </div>
                    <div class="pull-left m-r">
                        <span class="img-avatar img-avatar-48 bg-gray-light-o"><i class="ion-power fa-1-5x"></i></span>
                    </div>
                </div>
            </a>
        </div>
        <!-- .col-sm-6 -->
    </div>
    <!-- .row -->
    <!-- End stats -->

    <div class="row mobile-hide">
        <!-- Company overview Chart -->
        <div class="col-lg-12">
                <div class="card">
                        <div class="card-header bg-blue bg-inverse">
                            <div class="h4">แจ้งเตือนประจำวันที่ {{date('d/m/Y', strtotime($now))}}</div>
                            <ul class="card-actions">
                                <li>
                                    <button type="button" data-toggle="card-action" data-action="refresh_toggle" data-action-mode="demo"><i class="ion-refresh"></i></button>
                                </li>
                                <li>
                                    <button type="button" data-toggle="card-action" data-action="fullscreen_toggle"><i class="ion-android-expand"></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <!-- Messages & Checkable Table (.js-table-checkable class is initialized in App() -> uiHelperTableToolsCheckable()) -->
                            <div class="pull-r-l">
                                <table class="js-table-checkable table table-hover table-vcenter m-b-0">
                                    <tbody>
                                    <tr>
                                        <td class="hidden-xs text-center"></td>
                                        <td class="font-500">ภาพถ่าย</td>
                                        <td class="hidden-xs font-500">รหัส</td>
                                        <td class="font-500">ชื่อ</td>
                                        <td class="hidden-xs font-500"> ประเภท </td>
                                        <td class="hidden-xs font-500">ยอดชำระ</td>
                                       
                                    </tr>
                                    <?php $num = 1;?>
                                @foreach ($datamain as $item)
                                
                                <tr onclick="location.href='{{ url('/detail/'.$item->id) }}'">
                                    <td class="hidden-xs text-center">
                                        <label class="css-input css-checkbox css-checkbox-default">
                                        <span>{{$num}}</span>
                                        </label>
                                    </td>
                                    <td class="font-200"><img src="{{asset('images/'.$item->image)}}" width="180px" height="100px"></td>
                                    <td class="font-300">{{$item->code}}</td>
                                    <td class="font-300">{{$item->name}}</td>
                                    <td>
                                        <div class="hidden-xs text-muted">                                                                                                                                                                                                                                                                                                                                                                                                   
                                                {{$item->type}}                                                                                                                                               
                                        </div>
                                    </td>
                                    <td class="visible-lg text-muted"><div class="text-muted">{{ number_format($item->interest, 0) }}</div></td>
                                    
                                </tr>
                                <?php $num ++;?>
                                @endforeach                          
                                    </tbody>
                                </table>
                            </div>
                            <!-- End Messages -->
                        </div>
                        <!-- .card-block -->
                    </div>
        </div>
            <!-- .card -->
        <!-- End Weekly transactions Widget -->
    </div>
    <div class="h4 mobile-show"  style="display:none;">แจ้งเตือนประจำวันที่ {{date('d/m/Y', strtotime($now))}}<hr /></div>
    <?php $nums = 1;?>
    @foreach ($datamain as $itemM)
    <div class="col-lg-6 mobile-show"  style="display:none;">
            <div class="card">
                    <div class="card-block">
                            <a href="{{ url('/detail/'.$itemM->id) }}"> <img class="img-responsive" src="{{asset('images/'.$itemM->image)}}" alt=""> </a>
                    <p style="padding-top:20px">ชื่อ: {{$itemM->name}}<br />
                            รหัส: {{$itemM->code}} <br />
                            ประเภท: {{$itemM->type}}<br />
                            ยอดชำระ: {{ number_format($itemM->interest, 0) }}<br /></p>
                    </div>
                </div>
           
        </div>
    <!-- .row -->
    <?php $nums ++;?>
    @endforeach     
</div>
@endsection
