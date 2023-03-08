@extends('layouts.dashboard')

@section('content')

<!-- Page Content -->
 <!-- Page Content -->
 <div class="container-fluid p-y-md">
    <div class="row">
    
        <!-- .col-sm-5 -->
        <div class="col-sm-12 col-lg-12"></div>
        <div class="col-sm-12 col-lg-12">
                <div class="card">
                        <div class="card-header">
                            <h4>จัดการพนักงาน</h4>
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
                                            <td class="col-xs-6 b-r">
                                                <p class="h1">{{count($user)}}</p>
                                                <p class="h6 text-muted m-t-0">พนักงานทั้งหมด</p>
                                            </td>
                                            <td class="col-xs-6" data-toggle="modal" data-target="#modal-top">
                                                <i class="ion-person-add fa-3x text-muted"></i>
                                                <p class="h6 text-muted m-t-0">เพิ่มพนักงานใหม่</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <ul class="list-users">
                                @foreach($user as $item)
                                <li>
                                <a href="#" data-toggle="modal" data-target="#modal-top{{$item->id}}">
                                        <img class="img-avatar" src="{{asset('image/'.$item->image)}}" alt="">
                                        <i class="ion-record text-{{$item->isactive==1?'green':'red'}} "></i> {{$item->name}}
                                        <p class="small text-muted">{{$item->level==0?'ผู้ดูแลระบบ':'พนักงานทั่วไป'}}</p>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
        </div>
        <div class="col-sm-12 col-lg-2"></div>
        <!-- .col-sm-7 -->
    </div>
    <!-- .row -->
</div>
<!-- .container-fluid -->
<!-- End Page Content -->
<div class="modal fade" id="modal-top" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
        <form action="{{URL::to('/adduser')}}" method="POST" enctype="multipart/form-data">
            <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <div class="card-header bg-green bg-inverse">
                    <h4>เพิ่มพนักงานใหม่</h4>
                    <ul class="card-actions">
                        <li>
                            <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                        </li>
                    </ul>
                </div>
                
                <div class="card-block">
                
                                @csrf
                                <div class="form-group row">
                                    <div class="col-xs-6">
                                        <label for="exampleInputName1">ชื่อผู้ใช้งาน</label>
                                        <input type="text" class="form-control" id="exampleInputName1" name="name" autocomplete="off">
                                    </div>
                                    <div class="col-xs-6">
                                        <label for="exampleInputName2">อีเมล</label>
                                        <input type="email" class="form-control" id="exampleInputName2" name="email" autocomplete="off">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-xs-6">
                                        <label for="exampleInputPassword2">รหัสผ่าน</label>
                                        <input type="password" class="form-control" id="exampleInputPassword2" name="password" autocomplete="off">
                                    </div>
                                    <div class="col-xs-6">
                                            <label for="exampleInputPassword2">รูปภาพ</label>
                                            <input type="file" id="image" class="form-control" name="image" required>
                                            <img class="img-responsive" id="imgpreview" width="250" src="" alt="" style="display:none;">
                                    </div>
                                </div>
                                <div class="form-group row">
                                        <div class="col-xs-6">
                                            <label for="exampleInputPassword2">กำหนดสิทธิ์</label>
                                            <select class="form-control" name="level" id="" required>
                                                    <option value="">--กรุณาเลือก--</option>
                                                    <option value="1">พนักงานทั่วไป</option>   
                                                    <option value="0">ผู้ดูแลระบบ</option>           
                                            </select>
                                        </div>
                                        <div class="col-xs-6">
                                                <label for="exampleInputPassword2">สถานะการทำงาน</label>
                                                <select class="form-control" name="isactive" id="" required>
                                                        <option value="1">เปิดใช้งาน</option>   
                                                        <option value="0">ปิดใช้งาน</option>           
                                                </select>
                                        </div>
                                    </div>
                           
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">ปิด</button>
                    <button class="btn btn-sm btn-app" type="submit"><i class="ion-checkmark"></i> บันทึก</button>
                </div> 
            </div>
        </div>
    </form>
    </div>




    @foreach($user as $item)
<div class="modal fade" id="modal-top{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
            <form action="{{URL::to('/edituser')}}" method="POST" enctype="multipart/form-data">
                <div class="modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <div class="card-header bg-blue bg-inverse">
                    <h4>แก้ไขข้อมูล</h4>
                        <ul class="card-actions">
                        <input type="hidden" name="userID" value="{{$item->id}}">
                            <li>
                                <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                            </li>
                        </ul>
                    </div>
                    
                    <div class="card-block">
                    
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-xs-6">
                                            <label for="exampleInputName1">ชื่อผู้ใช้งาน</label>
                                        <input type="text" class="form-control" id="exampleInputName1" value="{{$item->name}}" name="name" autocomplete="off">
                                        </div>
                                        <div class="col-xs-6">
                                            <label for="exampleInputName2">อีเมล</label>
                                            <input type="email" class="form-control" id="exampleInputName2" value="{{$item->email}}" name="email" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-xs-6">
                                            <label for="exampleInputPassword2">รหัสผ่าน</label>
                                            <input type="password" class="form-control" id="exampleInputPassword2" value="....." name="password" autocomplete="off">
                                        </div>
                                        <div class="col-xs-6">
                                                <label for="exampleInputPassword2">รูปภาพ</label>
                                                <input type="file" id="image" class="form-control" name="image">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                            <div class="col-xs-6">
                                                <label for="exampleInputPassword2">กำหนดสิทธิ์</label>
                                                <select class="form-control" name="level" id="" required>
                                                        <option value="">--กรุณาเลือก--</option>
                                                <option value="1" {{$item->level==1?'selected="selected"':''}}>พนักงานทั่วไป</option>   
                                                        <option value="0" {{$item->level==0?'selected="selected"':''}}>ผู้ดูแลระบบ</option>           
                                                </select>
                                            </div>
                                            <div class="col-xs-6">
                                                    <label for="exampleInputPassword2">สถานะการทำงาน</label>
                                                    <select class="form-control" name="isactive" id="" required>
                                                            <option value="1" {{$item->isactive==1?'selected="selected"':''}}>เปิดใช้งาน</option>   
                                                            <option value="0" {{$item->isactive==0?'selected="selected"':''}}>ปิดใช้งาน</option>           
                                                    </select>
                                            </div>
                                        </div>
                               
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">ปิด</button>
                        <button class="btn btn-sm btn-app-blue" type="submit"><i class="ion-checkmark"></i> บันทึก</button>
                    </div> 
                </div>
            </div>
        </form>
        </div>
    @endforeach
@endsection
