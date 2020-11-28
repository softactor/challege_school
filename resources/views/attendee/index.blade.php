@extends('layouts.app')
@section('css')
<style>

</style>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a href="{{route('importCSV')}}"  class="btn btn-sm btn-success">Import CSV</a>
            <a href="{{route('sampleCSV')}}"  class="btn btn-sm btn-success">Sample CSV</a>
            <a href="{{route('addAttendee')}}"  class="btn btn-sm btn-success">Add</a>
        </div>
        <div class="panel-body">
            <table class="table table-bordered list-table-custom-style" id="attendeeTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Country</th>
                        <th>Company</th>
                        <th>Vcard</th>
                        <th>Action</th>
                    </tr>					
                </thead>
                <tbody>
                    @php $i = 1 @endphp
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
                                if(isset($attendee->vcard_path) && !empty($attendee->vcard_path)){
                                    $vcardFullPath  =   public_path('vcards/'.$attendee->vcard_path);
                                    $vcardPath      =   asset('public/vcards/'.$attendee->vcard_path);                                    
                                    if (file_exists($vcardFullPath)) {
                                        echo '<img src="'.$vcardPath.'">';
                                    }
                                }
                            
                            ?>
                        </td>
                        <td>
                            <a href="{{route('editAttendee',[$attendee['id']])}}"  class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <a href="{{route('deleteAttendee',[$attendee['id']])}}" onclick="return confirm('Are you sure you want to delete this attendee?');" class="btn btn-sm btn-danger">
                                <i class="fas fa-times"></i>
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
        $('#attendeeTable').DataTable({
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

