@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-3">
                        <h4 class="card-title">Attendee List</h4>
                    </div>
                    <div class="col-md-9 text-right">

                        <a href="{{route('importCSV')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Import CSV
                            </button>
                        </a>
                        <a href="{{route('sampleCSV')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Sample CSV
                            </button>
                        </a>
                        <a href="{{route('addAttendee')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Add Attendee
                            </button>
                        </a>
                        <a href="javascript:void(0)" onclick="delete_all_attendee();">
                            <button type="button" class="btn btn-rounded btn-danger">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Delete All
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="attendeeTable" class="display" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Event Name</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Country</th>
                                <th>Company</th>
                                <th>Qrcode</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            <?php $dashboardUrl       = get_registro_dashboard_url(); ?>
                            @foreach($attendees as $attendee)
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{ getEventName($attendee->event_id) }}</td>
                                <td><?php echo $attendee->salutation . " " . $attendee->first_name . " " . $attendee->last_name ?></td>
                                <td>{{$attendee->email}}</td>
                                <td>{{ getTypeName($attendee->type_id) }}</td>
                                <td>{{$attendee->country}}</td>
                                <td>{{$attendee->company}}</td>
                                <td>
                                    <?php
                                    $dashboardQrImage   = is_qrcode_enable($attendee->event_id);
                                    echo show_attendee_qrcode($dashboardUrl, $dashboardQrImage, $attendee);
                                    ?>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{route('editAttendee',[$attendee['id']])}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{route('deleteAttendee',[$attendee['id']])}}" onclick="return confirm('Are you sure you want to delete this attendee?');" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fa fa-close"></i>
                                        </a>
                                    </div>
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

@endsection

@section('page-script')
<script>
    $(document).ready(function() {
        $('#attendeeTable').DataTable({
            language: {
                paginate: {
                    next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                    previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
                }
            },
            responsive: true,
            columnDefs: [{
                    responsivePriority: 1,
                    targets: 0
                },
                {
                    responsivePriority: 10001,
                    targets: 4
                },
                {
                    responsivePriority: 2,
                    targets: -2
                }
            ]
        });
    });
</script>
@endsection