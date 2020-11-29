<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Registro Namebadge') }}</title>
        <link rel="shortcut icon" type="image/png" href="<?php echo asset('public/image/registro_Logo-PNG.png') ?>"/>

        <!-- Scripts -->
        <script src="{{URL::asset('public/js/jquery-3.3.1.min.js')}}" type="text/javascript"></script>
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- fontawesome icon-->
        <link href="{{ URL::asset('public/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/fontawesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
        <link href="{{ URL::asset('public/js/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/css/bootstrap-panel.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/css/sweetalert.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/css/style.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/css/datatable/jquery.dataTables.min.css') }}" rel="stylesheet">
        <link href="{{ URL::asset('public/css/simple-sidebar.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="namebadgeDirectPrintSection"></div>
        <div id="app">		
            <div class="d-flex" id="wrapper">

                <!-- Sidebar -->
                <div class="bg-light border-right" id="sidebar-wrapper">
                    <div class="sidebar-heading">Badge Design </div>
                    <div class="list-group list-group-flush">
                        <a href="{{ route('eventList') }}" class="list-group-item list-group-item-action bg-light">Events</a>
                        <a href="{{ route('userTypes') }}" class="list-group-item list-group-item-action bg-light">User Types</a>
                        <a href="{{ route('custom_fields_view') }}" class="list-group-item list-group-item-action bg-light">Custom Fields</a>
                        <a href="{{ route('attendeeList') }}" class="list-group-item list-group-item-action bg-light">Attendees</a>
                        <a href="{{ route('templateList') }}" class="list-group-item list-group-item-action bg-light">Templates</a>
                        <a href="{{ route('print_attendee') }}" class="list-group-item list-group-item-action bg-light">Print Station</a>
                    </div>
                </div>
                <!-- /#sidebar-wrapper -->

                <!-- Page Content -->
                <div id="page-content-wrapper">

                    <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                        <button class="" id="menu-toggle"><img src="{{ URL::asset('public/menubar.png')}}" height="30px" width="30px" /></button>

                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                                <!--<li class="nav-item active">
                                  <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" href="#">Link</a>
                                </li>-->
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Admin
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <!--<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>-->
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <!--<a class="dropdown-item" href="#">Another action</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Something else here</a>-->
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div class="container-fluid">
                        <main class="py-4">
                            @include('flash-message')
                            @yield('css')
                            @yield('content')
                        </main>                        
                    </div>
                </div>
                <!-- /#page-content-wrapper -->

            </div>
            <!-- /#wrapper -->
        </div>
        <!-- Menu Toggle Script -->        
        <script src="{{URL::asset('public/js/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/jquery.datetimepicker.full.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/sweetalert.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/fabric.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/datatable/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        <script>
            $(document).ready(function() {
            $("#evet_start_date").datetimepicker();
            });
            $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
            });
            function deletConfirmation(url, delete_id){
            swal(
                {
                    title: "Are you sure?",
                    text: "You want to delete?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false
                },
            function(isConfirm){
                if (isConfirm){
                    $.ajax({
                        url         : url,
                        type        : 'Get',
                        dataType    : 'json',
                        data        : 'event_id=' + delete_id,
                        success     : function (response) {
                            if (response.status == 'success'){
                                swal("Deleted", response.message, "success");
                                setTimeout(function(){
                                    location.reload();
                                }, 2000);
                            } else{
                                swal("Failed", response.message, "error");
                            }
                        },
                        async: false // <- this turns it into synchronous
                    });
                }
            });
        }
        
        function confirm_namebadge_print(attendee_id){
            swal(
                {
                    title: "Are you sure?",
                    text: "You want to Print?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "btn-green",
                    confirmButtonText: "Yes",
                    closeOnConfirm: false
                },
            function(isConfirm){
                if (isConfirm){
                    var printHistoryRes     =   update_printing_history(attendee_id);
                    namebadge_printing_execution(attendee_id);
                }
            });
        }
        
        function update_printing_history(attendee_id){
            var responseFeedback    =   false;
            $.ajax({
                url         : '{{route("update_attendee_printing_history")}}',
                type        : 'Get',
                dataType    : 'json',
                data        : 'attendee_id=' + attendee_id,
                success     : function (response) {
                    if (response.status == 'success'){
                        responseFeedback    =   true;
                        $('#printing_status_'+attendee_id).html(response.printingStatus);
                        $('#printing_not_'+attendee_id).html(response.nop);
                        $('#printing_date_'+attendee_id).html(response.printingDate);
                    } else{
                        responseFeedback    =   false;
                    }
                },
                async: false // <- this turns it into synchronous
            });
            return responseFeedback
        }
        
        function namebadge_printing_execution(attendee_id){
            setTimeout(function () {
                w = window.open(window.location.href, "_blank");
                w.document.open();
                w.document.write($('#print_preview_'+attendee_id).html());
                w.document.close();
                w.window.print();
                swal.close();
                setTimeout(w.window.close, 0);
            }, 2000);
        }
        
        function print_namebadge_by_serial_number(){
            var serialNumber    =   $('#registration_id').val();
            $.ajax({
                url         : '{{route("print_namebadge_by_serial_number")}}',
                type        : 'POST',
                dataType    : 'json',
                data        : 'serial_number=' + serialNumber,
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success     : function (response) {
                    if(response.status == 'success'){
                        update_printing_history(response.attendee_id);
                        $('#namebadgeDirectPrintSection').html(response.data);
                        setTimeout(function () {
                            w = window.open(window.location.href, "_blank");
                            w.document.open();
                            w.document.write($('#namebadgeDirectPrintSection').html());
                            w.document.close();
                            w.window.print();
                            swal.close();
                            setTimeout(w.window.close, 0);
                            $('#namebadgeDirectPrintSection').hide();
                            $("#registration_id").val('');
                            $("#registration_id").focus();
                        }, 2000);
                    }else{
                        $('#namebadgeDirectPrintSection').html('');
                        swal("Failed", 'No Data', "error");
                    }
                },
                async: false // <- this turns it into synchronous
            });
        }
        
        </script>
        @yield('page-script')
    </body>
</html>
