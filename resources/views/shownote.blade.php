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
                            
                        </ul>
                    </div>
                    <div class="card-block">
                            <form method="POST" action="{{ url('/editnote') }}" accept-charset="UTF-8" class="form-horizontal m-t-xs" enctype="multipart/form-data">

                                @csrf
                                <div class="form-group">
                                        
                                        <input type="hidden" name="id" id="id" value="{{$note->id}}">
                                         <input type="hidden" name="islock" value="1" >                                                </label>
                                               
                                </div>
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div>
                                    <input class="form-control code" type="text" value="{{$note->topic}}"  id="topic" name="topic" required="required" placeholder="กรุณาใส่ชื่อเรื่อง">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12">
                                    <div class="form-group">
                                        <div> <textarea id="mytextarea" name="body">{{$note->body}}</textarea></div>
                                    </div>
                                </div>
                             
                            
                    </div>
                    <div class="modal-footer">
                    <a href="{{url('/note') }}"><button class="btn btn-sm btn-default" type="button" data-dismiss="modal">ปิด</button>
                        <button class="btn btn-sm btn-app-blue" type="submit" id="btaddmain"><i class="ion-checkmark"></i> บันทึก</button>
                    </div>
                </form>
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
                    
                </div>
            </div>
        </div>
    
    <!-- .row -->
</div>
@endsection
