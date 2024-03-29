<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Registro Namebadge') }}</title>
    <link rel="shortcut icon" type="image/png" href="<?php echo asset('public/image/registro_Logo-PNG.png') ?>"/>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Meta -->
    <meta name="description" content="@yield('meta_description', 'Default Description')">
    <meta name="author" content="@yield('meta_author', 'Registro')">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">

    <script>
        window.Laravel = '<?php echo json_encode(['csrfToken' => csrf_token()]) ?>';
    </script>
    <?php
    if (!empty($google_analytics)) {
        echo $google_analytics;
    }
    ?>
    <link href="{{ URL::asset('public/css/jquery.datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('public/css/style.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('public/theme/vendor/datatables/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/theme/vendor/chartist/css/chartist.min.css') }}">
    <link href="{{ asset('public/theme/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/theme/vendor/owl-carousel/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('public/theme/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/theme/css/style_theme_custome.css') }}" rel="stylesheet">

    <style type="text/css">
        .phpdebugbar {
            display: none !important;
        }

        .messages-menu,
        .notifications-menu,
        .tasks-menu {
            display: none !important;
        }
    </style>
</head>

<body>
    <div id="namebadgeDirectPrintSection"></div>
    <div class="loading" style="display:none"></div>

    <!-- Preloader start -->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>

    <!-- Main wrapper start  -->
    <div id="app">
        <div id="main-wrapper">

            <!-- Header Top menu start -->


            @include('includes.top_navbar')

            <!-- start left sidebar -->

            @include('includes.left_sidebar')

            <!-- Content body start -->
            <div class="content-body">

                <div class="container-fluid">
                    @yield('content')
                </div>


            </div>

            <!-- Content body end -->

            <div class="footer">
                <div class="copyright">
                    <p>Copyright © Designed &amp; Developed by <a href="https://registro.asia/" target="_blank">Registro Asia</a> 2018</p>
                </div>
            </div>
            <!-- Footer end -->

        </div>
    </div>

    <!-- JavaScripts -->

    <!-- Menu Toggle Script --> 
        <script src="<?php echo asset('public/theme/vendor/global/global.min.js') ?>"></script>       
        <script src="{{URL::asset('public/js/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/jquery.datetimepicker.full.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/moment.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/sweetalert.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/fabric.min.js')}}" type="text/javascript"></script>
        <script src="{{URL::asset('public/js/datatable/jquery.dataTables.min.js')}}" type="text/javascript"></script>
        
        


    <!-- theme js start -->



    <script src="<?php echo asset('public/theme/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')  ?>"></script>



    <script src="<?php echo asset('public/theme/js/plugins-init/datatables.init.js')  ?>"></script>


    <script src="<?php echo asset('public/theme/vendor/chart.js/Chart.bundle.min.js')  ?>"></script>

    <!-- Chart piety plugin files -->
    <script src="<?php echo asset('public/theme/vendor/peity/jquery.peity.min.js')  ?>"></script>

    <!-- Apex Chart -->
    <script src="<?php echo asset('public/theme/vendor/apexchart/apexchart.js')  ?>"></script>

    <script src="<?php echo asset('public/theme/vendor/owl-carousel/owl.carousel.js')  ?>"></script>
    <script src="<?php echo asset('public/theme/js/custom.min.js')  ?>"></script>
    <script src="<?php echo asset('public/theme/js/deznav-init.js')  ?>"></script>


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


    <!-- theme js end -->
    @yield('page-script')
</body>

</html>