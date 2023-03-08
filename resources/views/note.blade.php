@extends('layouts.dashboard')

@section('content')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=1p51v5891z6ds4md2vz6zu1lql6k0ke47xn6qa1tckxu1zx5"></script>
<script>
        tinymce.init({
          selector: '#mytextarea'
        });
        </script>
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
                        <div class="h4">บันทึกส่วนตัว</div>
                        <ul class="card-actions">
                            <li>
                                <button type="button" data-toggle="modal" data-target="#modal-popout" ><i class="ion-android-add-circle fa-2x"></i></button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-block" style="padding-top:0px">
                        <!-- Messages & Checkable Table (.js-table-checkable class is initialized in App() -> uiHelperTableToolsCheckable()) -->
                        <div class="form-group">
                                
                            </div>
                        <div class="pull-r-l">
                                
                            <table class="js-table-checkable table table-hover table-vcenter m-b-0">
                                <tbody>
                                <tr>
                                    <td class="font-300 hidden-xs">ลำดับ</td>
                                    <td class="font-500">หัวข้อเรื่อง</td>
                                    <td class="font-300 hidden-xs" >วันที่</td>
                                    <td class="font-100 hidden-xs" style="text-align:center">ลบ</td>
                                </tr>
                                <?php $num=1;?>
                                @foreach($note as $item)
                                
                            <tr>
                                        <td class="font-300 hidden-xs" data-toggle="modal" data-target="#modal-small{{$item->id}}">{{$item->id}}{{$num}}</td>
                                        <td class="font-500 " data-toggle="modal" data-target="#modal-small{{$item->id}}"><i class="{{$item->islock?"fa fa-key fa":"fa fa-unlock"}}"></i>{{$item->topic}}</td>
                                        <td class="font-300 hidden-xs" data-toggle="modal" data-target="#modal-small{{$item->id}}">{{$item->created_at}}</td>
                                        <td class="text-center">
                                                <div class="btn-group">
                                                    <a href="{{ url('/delnote/'.$item->id) }}" onclick="return confirm('คุณต้องการลบ?')"><button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="" data-original-title="Remove client"><i class="ion-close"></i></button></a>
                                                </div>
                                        </td>
                                </tr>
                                <?php $num++;?>
                                <div class="modal" id="modal-small{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <div class="card-header bg-green bg-inverse">
                                                    <h4>กรุณากรอกรหัสผ่านขอบคุณ</h4>
                                                    <ul class="card-actions">
                                                        <li>
                                                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="card-block">
                                                        <form method="POST" action="{{ url('/shownote') }}" accept-charset="UTF-8" class="form-horizontal m-t-xs" enctype="multipart/form-data">

                                                            @csrf
                                                        
                                                        <div class="col-xs-12">
                                                            <div class="form-group">
                                                                <div>
                                                                <input type="hidden" name="id" value="{{$item->id}}">
                                                                <input class="form-control code" type="password" value=""  id="password" name="password" autocomplete="off" required="required" placeholder="กรุณาใส่รหัสผ่าน">
                                                                </div>
                                                            </div>
                                                        </div>                                                         
                                                        
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">ปิด</button>
                                                    <button class="btn btn-sm btn-app-blue" type="submit" id="btaddmain"><i class="ion-checkmark"></i> เปิดดู</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <!-- .card-block -->
                </div>
    </div>
    <!-- .row -->
    <!-- End stats -->
    <div class="modal fade" id="modal-popout" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-popout">
                <div class="modal-content">
                    <div class="card-header bg-green bg-inverse">
                        <h4>สร้างบันทึก</h4>
                        <ul class="card-actions">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                            </li>
                        </ul>
                    </div>
                    <div class="card-block">
                            <form method="POST" action="{{ url('/addnote') }}" accept-charset="UTF-8" class="form-horizontal m-t-xs" enctype="multipart/form-data">

                                @csrf
                                <div class="form-group" style="display:none;">
                                        <div class="col-xs-12">
                                                <label class="css-input css-radio css-radio-lg css-radio-primary m-r-sm">
                                                    <input type="radio" name="islock" value="1" checked><span></span> รหัสสองชั้น
                                                </label>
                                                <label class="css-input css-radio css-radio-lg css-radio-danger">
                                                    <input type="radio" name="islock" value="0" ><span></span> ไม่ต้องเข้า
                                                </label>
                                        </div>
                                </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div>
                                    <input class="form-control code" type="text" value=""  id="topic" name="topic" required="required" placeholder="กรุณาใส่ชื่อเรื่อง">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                    <div class="form-group">
                                        <div> <textarea id="mytextarea" name="body"></textarea></div>
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
    
    <!-- .row -->
</div>
@endsection
