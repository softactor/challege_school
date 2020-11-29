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
                    <form class="form-inline" id="registration_id_scan_form">
                        <label for="text">SCAN ID:</label>
                         <!--onchange="print_namebadge_by_serial_number();"-->
                          <!--onclick="print_namebadge_by_serial_number()"-->
                        <input type="text" class="form-control" style="width: 87%;margin-right: 1%;margin-left: 1%;" id="registration_id" name="registration_id" tabindex="1" autofocus="autofocus" onchange="print_namebadge_by_serial_number();">
                        <button type="button" class="btn btn-primary">Scan</button>
                    </form>
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
    });
</script>
@endsection

