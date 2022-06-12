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
                        <?php if(Auth::user()->role_id  ==  1){ ?>
                        <a href="{{ route('eventList') }}" class="list-group-item list-group-item-action bg-light">Events</a>
                        <?php } ?>
                        
                        <?php if(Auth::user()->role_id  ==  1){ ?>
                        <a href="{{ route('userTypes') }}" class="list-group-item list-group-item-action bg-light">User Types</a>
                        <?php } ?>
                        
                        <?php if(Auth::user()->role_id  ==  1){ ?>
                        <a href="{{ route('custom_fields_view') }}" class="list-group-item list-group-item-action bg-light">Custom Fields</a>
                        <?php } ?>
                        
                        <?php if(Auth::user()->role_id  ==  1  || Auth::user()->role_id  ==  2){ ?>
                        <a href="{{ route('attendeeList') }}" class="list-group-item list-group-item-action bg-light">Attendees</a>
                        <?php } ?>
                        
                        <?php if(Auth::user()->role_id  ==  1){ ?>
                        <a href="{{ route('templateList') }}" class="list-group-item list-group-item-action bg-light">Templates</a>
                        <?php } ?>
                        
                        <?php if(Auth::user()->role_id  ==  1  || Auth::user()->role_id  ==  2){ ?>
                        <a href="{{ route('print_attendee') }}" class="list-group-item list-group-item-action bg-light">Print Station</a>
                        <?php } ?>
                        
                        <?php if(Auth::user()->role_id  ==  1  || Auth::user()->role_id  ==  2){ ?>
                        <a href="{{ route('print_report') }}" class="list-group-item list-group-item-action bg-light">Print Report</a>
                        <?php } ?>
                        
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
                                        <?php echo Auth::user()->name ?>
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
        var mywindow;
        
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
        
        $("#save_n_print").click(function(){
           var form = $("#attendee_add_form");

           var formData = new FormData(form[0]);
//           let photoFiles = $("#attendee_photo")[0].files[0];
//           fd.append('file', photoFiles);
           
           $.ajax({
                url         : '{{route("attendee_data_save_n_print")}}',
                type        : 'POST',
                dataType    : 'json',
                data        : formData,
                contentType : false,
                processData : false,
                async: false, // <- this turns it into synchronous
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
                },
                success     : function (response) {
                    
                    if(response.status == 'success'){
                    
                        $('#attendee_badge_show').html(response.namebadge);

                        namebadge_printing_execution(response.attendee_id);
                        setTimeout(function () {
                            $('.print-error-msg').hide();
                            $('#print_preview_'+response.attendee_id).remove();
                            $('#attendee_add_form')[0].reset();
                        }, 4000);
                    
                    }else{
                        
                        printErrorMsg(response.data);
                    } 
                }
            });    
        });
        
        
        function printErrorMsg (msg) {
            $(".print-error-msg").find("ul").html('');
            $(".print-error-msg").css('display','block');
            $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
            });
    }
        
        function namebadge_printing_execution(attendee_id){
            var divName = 'print_preview_'+attendee_id;
            namebadge_printing(divName);
        }
        
        function namebadge_printing(divName, hideDirSec=false){
            setTimeout(function () {
                mywindow = window.open(window.location.href, "_blank");
                mywindow.document.open();
                mywindow.document.write($('#'+divName).html());
                mywindow.document.close();
                mywindow.window.print();
                swal.close();
                closeWin();
                if(hideDirSec){
                    $('#namebadgeDirectPrintSection').hide();
                    $("#registration_id").val('');
                    $("#registration_id").focus();
                }
            }, 3000);
        }
        function closeWin() {
            mywindow.close();
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
                        var divName =   'namebadgeDirectPrintSection';
                        namebadge_printing(divName, hideDirSec=true);                        
                    }else{
                        $('#namebadgeDirectPrintSection').html('');
                        swal("Failed", 'No Data', "error");
                    }
                },
                async: false // <- this turns it into synchronous
            });
        }
       function delete_all_attendee(){
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
                        url         : '{{route("delete_all_attendee")}}',
                        type        : 'GET',
                        dataType    : 'json',
                        success     : function (response) {
                            if (response.status == 'success'){
                                swal("Deleted", response.message, "success");
                                setTimeout(function(){
                                    location.reload();
                                }, 3000);
                            } else{
                                swal("Failed", response.message, "error");
                            }
                        },
                        async: false // <- this turns it into synchronous
                    });
                }
            });
       }
       
       function get_event_settings_data(event_id){
           if(event_id){
               $.ajax({
                    url         : '{{route("get_event_settings_data")}}',
                    type        : 'GET',
                    dataType    : 'json',
                    data        : 'event_id='+event_id,
                    success     : function (response) {
                        if (response.status == 'success'){                            
                            
                            if(response.data.enable_vcard){
                                $('#enable_vcard').prop('checked', true);
                            }else{
                                $('#enable_vcard').prop('checked', false);
                            }
                            
                            if(response.data.enable_qrcode){
                                $('#enable_qrcode').prop('checked', true);
                            }else{
                                $('#enable_qrcode').prop('checked', false);
                            }
                            
                            if(response.data.enable_barcode){
                                $('#enable_barcode').prop('checked', true);
                            }else{
                                $('#enable_barcode').prop('checked', false);
                            }
                            
                            
                            if(response.data.enable_sync_dashboard){
                                $('#enable_sync_dashboard').prop('checked', true);
                            }else{
                                $('#enable_sync_dashboard').prop('checked', false);
                            }
                            
                            
                            if(response.data.qrcode_type){
                                $('#qrcode_type').val(response.data.qrcode_type);
                            }else{
                                $('#qrcode_type').val('');
                            }
                            
                            
                            swal("Data Found", response.message, "success");
                            setTimeout(function(){
                                swal.close();
                            }, 2000);
                        } else{
                            swal("Data Not Found", response.message, "error");
                            $('#enable_vcard').prop('checked', false);
                            $('#enable_qrcode').prop('checked', false);
                            $('#enable_barcode').prop('checked', false);
                            $('#enable_sync_dashboard').prop('checked', false);
                        }
                    },
                    async: false // <- this turns it into synchronous
                });
           }else{
               $('#enable_vcard').prop('checked', false);
               $('#enable_qrcode').prop('checked', false);
               $('#enable_barcode').prop('checked', false);
               $('#enable_sync_dashboard').prop('checked', false);
           }
       }
       
       
       
       
        </script>
        @yield('page-script')
    </body>
</html>
