@extends('layouts.app')
@section('css')
<style>

</style>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-borderless" style="width: 100%">
                        <tr>
                            <td style="width:7%; text-align: right;">SCAN ID:</td>
                            <td style="width:90%; text-align: left;">
                                <input type="text" class="form-control" style="width: 90%;margin-right: 1%;margin-left: 1%;" id="registration_id" name="registration_id" tabindex="1" autofocus="autofocus" onchange="print_namebadge_by_serial_number();" onblur="print_namebadge_by_serial_number();">
                                <!--<button type="button" class="btn btn-success" onclick="print_namebadge_by_serial_number()">Get</button>-->
                            </td>
                        </tr>
                    </table>
                     <!--onchange="print_namebadge_by_serial_number();" onblur="print_namebadge_by_serial_number();"-->
                        <!--onblur="print_namebadge_by_serial_number();"--> 
                         <!--onchange="print_namebadge_by_serial_number();"-->
                          <!--onclick="print_namebadge_by_serial_number()"-->
                        
                </div>
                <div style="margin: 40px 0;"></div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-bordered list-table-custom-style table-striped" id="attendeePrintTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Country</th>
                                    <th>Type</th>
                                    <th title="Printing Status">P.Status</th>
                                    <th title="Number Of Printing">NOP</th>
                                    <th title="Printing Date">P.Date</th>
                                    <th>Namebadge</th>
                                    <th>Action</th>
                                </tr>					
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach($attendees as $attendee)
                                <tr>
                                    <td style="font-size: 11px; font-weight: bold;">{{ $attendee->serial_number }}</td>
                                    <td><?php echo $attendee->salutation . " " . $attendee->first_name . " " . $attendee->last_name ?></td>
                                    <td>{{$attendee->email}}</td>
                                    <td>{{$attendee->country}}</td>                        
                                    <td><?php echo getTypeName($attendee->type_id) ?></td>                        
                                    <td><span id='printing_status_<?php echo $attendee->id; ?>'><?php echo getAttendeePrintedStatus($attendee->id); ?></span></td>
                                    <td><span id='printing_not_<?php echo $attendee->id; ?>'><?php echo getAttendeenop($attendee->id); ?></span></td>
                                    <td><span id='printing_date_<?php echo $attendee->id; ?>'><?php echo getAttendeePrintedDate($attendee->id); ?></span></td>
                                    <td>
                                        <div id="print_preview_<?php echo $attendee->id; ?>">
                                            <?php echo $attendee->namebadgeView; ?>
                                        </div>
                                    </td>
                                    <td style="text-align: center;">
                                        <a href="javascript:void(0)" onclick="confirm_namebadge_print('<?php echo $attendee->id; ?>');" class="btn btn-sm btn-success">
                                            <i class="fas fa-print"></i> 
                                        </a>
                                    </td>
                                </tr>
                                @php $i++ @endphp
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection

@section('page-script')
<script>
    $(document).ready(function () {
        $('#attendeePrintTable').DataTable({
            responsive: true,
            columnDefs: [
                {responsivePriority: 1, targets: 0},
                {responsivePriority: 10001, targets: 4},
                {responsivePriority: 2, targets: -2}
            ]
        });



        var golobalDataTable    =   $('#attendeePrintTable_').DataTable( {
                                            "processing": true,
                                            "serverSide": true,
                                            "ajax": {
                                                url:"<?php echo url('get_attendee_print_table_data'); ?>",
                                                type:'POST',
                                                dataType:'json',
                                                data:{
                                                    "_token"    : $('meta[name="csrf-token"]').attr('content'),
                                                    "event_id"  : $("#selected_event_id").val()
                                                }
                                            },
                                            "columns":[
                                                {"data":"checkbox","searchable":false,"orderable":false},
                                                {"data":"serial_number"},
                                                {"data":"is_status"},
                                                {"data":"first_name"},
                                                {"data":"email"},
                                                {"data":"country_id"},
                                                {"data":"namebadge_user_label"},
                                                {"data":"type"},
                                                {"data":"reg_on"},
                                                {"data":"approval_status"},
                                                {"data":"action"}
                                            ],
                                            "aoColumnDefs": [
                                                { "bSortable": false, "aTargets": [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ] }
                                            ],
                                            "lengthMenu": [[10, 250, 500, -1], [10,250, 500, "All"]]
                                        } );






    });
</script>
@endsection

