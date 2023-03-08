<!DOCTYPE html>

<html class="app-ui">

    <head>
        <!-- Meta -->
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />

        <!-- Document title -->
        <title>@yield('title')</title>

        <!-- Favicons -->
        <link rel="apple-touch-icon" href="{{ asset('assets/img/favicons/apple-touch-icon.png')}}" />
        <link rel="icon" href="{{ asset('assets/img/favicons/favicon.ico') }}" />

        <!-- Google fonts -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,400italic,500,900%7CRoboto+Slab:300,400%7CRoboto+Mono:400" />
        <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
        <!-- Page JS Plugins CSS -->

        <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick/slick.min.css' ) }}" />
        <link rel="stylesheet" href="{{ asset('assets/js/plugins/slick/slick-theme.min.css' ) }}" />
        <!-- AppUI CSS stylesheets -->
        <link rel="stylesheet" id="css-font-awesome" href="{{ asset('assets/css/font-awesome.css' ) }}" />
        <link rel="stylesheet" id="css-ionicons" href="{{ asset('assets/css/ionicons.css' ) }}" />
        <link rel="stylesheet" id="css-bootstrap" href="{{ asset('assets/css/bootstrap.css' ) }}" />
        <link rel="stylesheet" id="css-app" href="{{ asset('assets/css/app.css' ) }}" />
        <link rel="stylesheet" id="css-app-custom" href="{{ asset('assets/css/app-custom.css' ) }}" />
        <!-- End Stylesheets -->
        <style>
                input[type='number'] {
                -moz-appearance:textfield;
            }
            
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
            }
            </style>
    </head>

    <body class="app-ui layout-has-drawer layout-has-fixed-header">
        
        <div class="app-layout-canvas">
            <div class="app-layout-container">

                <!-- Drawer -->
                <aside class="app-layout-drawer">

                    <!-- Drawer scroll area -->
                    <div class="app-layout-drawer-scroll">
                        <!-- Drawer logo -->
                        <div id="logo" class="drawer-header">
                        <a href="{{URL::to('/home')}}"><img class="img-responsive" src="{{ asset('assets/img/logo/logo-backend.png') }}" title="" alt="" /></a>
                        </div>

                        <!-- Drawer navigation -->
                        <nav class="drawer-main">
                            <ul class="nav nav-drawer">

                                <li class="nav-item nav-drawer-header">Apps</li>

                                <li class="nav-item active">
                                <a href="{{URL::to('/home')}}"><i class="ion-ios-bell-outline"></i> หน้าหลัก</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{URL::to('/listing')}}"><i class="ion-ios-book-outline"></i> ข้อมูลทั้งหมด</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{URL::to('/owed')}}"><i class="fa fa-search"></i> ค้นหายอดค้างชำระ</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{URL::to('/report')}}"><i class="fa fa-file-text-o"></i> รายงานผล</a>
                                </li>

                                <li class="nav-item">
                                        <a href="{{URL::to('/add')}}"><i class="ion-android-add-circle"></i> เพิ่มข้อมูล</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{URL::to('/note')}}"><i class="fa fa-book"></i> บันทึกส่วนตัว</a>
                                </li>
                                @if(Auth::user()->level==0)
                                <li class="nav-item">
                                    <a href="{{URL::to('/usermanager')}}"><i class="ion-ios-people-outline"></i> จัดการพนักงาน</a>
                                </li>
                                @endif


                            </ul>
                        </nav>
                        <!-- End drawer navigation -->

                        
                    </div>
                    <!-- End drawer scroll area -->
                </aside>
                <!-- End drawer -->

                <!-- Header -->
                <header class="app-layout-header">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar-collapse" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="ion-ios-search-strong"></span>
					<span class="icon-bar"></span>
				</button>
                                <button class="pull-left hidden-lg hidden-md navbar-toggle" type="button" data-toggle="layout" data-action="sidebar_toggle">
					<span class="sr-only">Toggle drawer</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
                                <span class="navbar-page-title">
					
                    ระบบจัดการข้อมูล
				</span>
                            </div>

                            <div class="collapse navbar-collapse" id="header-navbar-collapse">
                                <!-- Header search form -->
                            <form class="navbar-form navbar-left app-search-form" role="search" action="{{URL::to('listing')}}" method="GET">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input class="form-control" type="search" name="keyword" id="search-input" placeholder="ใส่คำที่ต้องการค้นหา" />
                                            <span class="input-group-btn">
								<button class="btn" type="submit"><i class="ion-ios-search-strong"></i></button>
							</span>
                                        </div>
                                    </div>
                                </form>

                                
                                <!-- .navbar-left -->

                                <ul class="nav navbar-nav navbar-right navbar-toolbar hidden-sm hidden-xs">
                                   
                                        <li class="dropdown">
                                                <a href="javascript:void(0)" data-toggle="dropdown" aria-expanded="false"><i class="ion-ios-bell"></i> <span class="badge" style="right: -7px">{{$notinumber}}</span></a>
                                                <ul class="dropdown-menu dropdown-menu-right" style="min-width: 380px;">
                                                   <a href="{{URL::to('history/new')}}" style="color:black"> <li class="dropdown-header">เพิ่มเข้ามาใหม่</li></a>
                                                    
                                                    @foreach($NewData as $NotiNew)
                                                    <li>
                                                    <a tabindex="-1" href="{{URL::to('detail/'.$NotiNew->id)}}"><span class="badge pull-right">{{$NotiNew->code}}</span> {{$NotiNew->type}} เมื่อ {{date('d/m/Y', strtotime($NotiNew->created_at))}}</a>
                                                    </li>
                                                    @endforeach
                                                    
                                                    
                                                    
                                                    <li class="divider"></li>
                                                    <a href="{{URL::to('history/update')}}" style="color:black"><li class="dropdown-header">แก้ไขล่าสุด</li></a>
                                                    @foreach($Editdata as $NotiNew)
                                                    <li>
                                                        <a tabindex="-1" href="{{URL::to('detail/'.$NotiNew->id)}}"><span class="badge pull-right">{{$NotiNew->code}}</span> {{$NotiNew->type}} เมื่อ {{date('d/m/Y', strtotime($NotiNew->updated_at))}}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                    <li class="dropdown dropdown-profile">
                                        <a href="javascript:void(0)" data-toggle="dropdown">
                                            <span class="m-r-sm">{{ Auth::user()->name }}<span class="caret"></span></span>
                                            <img class="img-avatar img-avatar-48" src="{{ asset('image/'.Auth::user()->image) }}" alt="" />
                                        </a>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="{{ url('/logout') }}">Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- .navbar-right -->
                            </div>
                        </div>
                        <!-- .container-fluid -->
                    </nav>
                    <!-- .navbar-default -->
                </header>
                <!-- End header -->

                <main class="app-layout-content">
                    @yield('content')
                    
                    <!-- .container-fluid -->
                    <!-- End Page Content -->

                </main>

            </div>
            <!-- .app-layout-container -->
        </div>
        <!-- .app-layout-canvas -->

        <!-- Apps Modal -->
        <!-- Opens from the button in the header -->
        <div id="apps-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-sm modal-dialog modal-dialog-top">
                <div class="modal-content">
                    <!-- Apps card -->
                    <div class="card m-b-0">
                        <div class="card-header bg-app bg-inverse">
                            <h4>Apps</h4>
                            <ul class="card-actions">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="ion-close"></i></button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-block">
                            <div class="row text-center">
                                <div class="col-xs-6">
                                    <a class="card card-block m-b-0 bg-app-secondary bg-inverse" href="index.html">
                                        <i class="ion-speedometer fa-4x"></i>
                                        <p>Admin</p>
                                    </a>
                                </div>
                                <div class="col-xs-6">
                                    <a class="card card-block m-b-0 bg-app-tertiary bg-inverse" href="frontend_home.html">
                                        <i class="ion-laptop fa-4x"></i>
                                        <p>Frontend</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- .card-block -->
                    </div>
                    <!-- End Apps card -->
                </div>
            </div>
        </div>
        <!-- End Apps Modal -->

        <div class="app-ui-mask-modal"></div>
 
     <!-- AppUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock and App.js -->
     <script src="{{asset('assets/js/core/jquery.min.js' ) }}"></script>
        <script src="{{asset('assets/js/core/bootstrap.min.js' ) }}"></script>
        <script src="{{asset('assets/js/core/jquery.slimscroll.min.js' ) }}"></script>
        <script src="{{asset('assets/js/core/jquery.scrollLock.min.js' ) }}"></script>
        <script src="{{asset('assets/js/core/jquery.placeholder.min.js' ) }}"></script>
        <script src="{{asset('assets/js/app.js' ) }}"></script>
        <script src="{{asset('assets/js/app-custom.js' ) }}"></script>

        <!-- Page Plugins -->
        <script src="{{asset('assets/js/plugins/slick/slick.min.js' ) }}"></script>
        <script src="{{asset('assets/js/plugins/chartjs/Chart.min.js' ) }}"></script>
        <script src="{{asset('assets/js/plugins/flot/jquery.flot.min.js' ) }}"></script>
        <script src="{{asset('assets/js/plugins/flot/jquery.flot.pie.min.js' ) }}"></script>
        <script src="{{asset('assets/js/plugins/flot/jquery.flot.stack.min.js' ) }}"></script>
        <script src="{{asset('assets/js/plugins/flot/jquery.flot.resize.min.js' ) }}"></script>


        <!-- for create product -->
        <script src="{{asset('assets/js/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js' ) }}"></script>
        <script src="{{asset('assets/js/plugins/jquery-validation/jquery.validate.min.js' ) }}"></script>

        <!-- Page JS Code -->
        <script src="{{asset('assets/js/pages/base_forms_wizard.js' ) }}"></script>
        <!-- Page JS Code -->
        <script src="{{asset('assets/js/pages/index.js' ) }}"></script> 
        <script>
            $(function()
            { 
                App.initHelpers('slick');
            });
        </script>


    </body>

</html>
