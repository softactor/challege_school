@extends('layouts.app')
@section('css')
<style>

</style>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table table-bordered list-table-custom-style table-striped" id="attendeePrintTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Country</th>
                        <th>Print Status</th>
                        <th>NOR</th>
                        <th>Printing Date</th>
                        <th>Namebadge</th>
                        <th>Action</th>
                    </tr>					
                </thead>
                <tbody>
                    @php $i = 1 @endphp
                    @foreach($attendees as $attendee)
                    <tr>
                        <td>{{$i}}</td>
                        <td><?php echo $attendee->salutation . " " . $attendee->first_name . " " . $attendee->last_name ?></td>
                        <td>{{$attendee->email}}</td>
                        <td>{{$attendee->country}}</td>                        
                        <td><span id='printing_status_<?php echo $attendee->id; ?>'><?php echo getAttendeePrintedStatus($attendee->id); ?></span></td>
                        <td><span id='printing_not_<?php echo $attendee->id; ?>'>NOR</span></td>
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

