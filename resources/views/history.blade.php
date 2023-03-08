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
                    <div class="card-header bg-green bg-inverse">
                        <div class="h4">{{$type=='new'?'ข้อมูลที่เพิ่มเข้ามาใหม่':'ประวัติการแก้ไขข้อมูล'}}</div>
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
                                
                            </div>
                        <div class="pull-r-l mobile-hide">
                                
                            <table class="js-table-checkable table table-hover table-vcenter m-b-0">
                                <tbody>
                                <tr>
                                    <td class="font-300">รหัส</td>
                                    <td class="font-50">ประเภท</td>
                                    <td class="font-500">วันที่</td>
                                    <td class="font-500">ผู้บันทึก</td>
                                </tr>
                                @foreach($data as $item)
                                
                                    <tr onClick="window.location='{{URL::to('detail/'.$item->id)}}';">
                                        <td class="font-300">{{$item->code}}</td>
                                        <td class="font-50">{{$item->type}}</td>
                                        @if($type=='new')<td class="font-500">{{date('d/m/Y', strtotime($item->created_at))}}</td>
                                        @else<td class="font-500">{{date('d/m/Y', strtotime($item->updated_at))}}</td>
                                        @endif
                                        <td class="font-500">{{$item->name}}</td>
                                </tr>
                                
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                        <div class="mobile-show" style="display:none">
                                @foreach($data as $item)
                                <a  href="{{URL::to('detail/'.$item->id)}}">
                                <p>รหัส: {{$item->code}}<br />
                                ประเภท: {{$item->type}} <br />
                                @if($type=='new')วันที่: {{date('d/m/Y', strtotime($item->created_at))}}<br />
                                @else วันที่: {{date('d/m/Y', strtotime($item->updated_at))}} <br />
                                @endif
                               ผู้บันทึก: {{$item->name}}</p><hr />
                                </a>
                                @endforeach
                        </div>

    
                       
                        <div style="width: 100%;    overflow-x: auto;    white-space: nowrap;">  {{$data->appends(request()->input())->onEachSide(1)->links() }} </div>
                    </div>
                    </div>
                    <!-- .card-block -->
                </div>
    </div>
    <!-- .row -->
    <!-- End stats -->

    
    <!-- .row -->
</div>
@endsection
