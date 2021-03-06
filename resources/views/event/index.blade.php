@extends('layouts.app')
@section('css')
<style>

</style>
@endsection

@section('content')
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5 class="float-left">Event List</h5>
            <div class="float-right">
                <a href="{{route('importEventCSV')}}"  class="btn btn-sm btn-success">Import Events</a>
                <a href="{{route('add_event')}}"  class="btn btn-sm btn-success text-right">Add Event</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered list-table-custom-style" id="eventTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Event Name</th>
                        <th>Event Date</th>
                        <th>Action</th>
                    </tr>					
                </thead>
                <tbody>
                    @php
                    $i = 1
                    @endphp
                    @foreach($events as $event)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$event->name}} (ID - {{$event->id}})</td>
                        <td>{{date("jS F, Y h:i a",strtotime($event->event_date))}}</td>
                        <td>
                            <?php
                                $del_url    = route('delete_event');
                                $del_id     = $event->id;
                            ?>
                            <a title="Edit" href="{{route('editEvent',[$event['id']])}}"  class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a title="Delete" href="javascript:void(0)" onclick="deletConfirmation('<?php echo $del_url; ?>',<?php echo $del_id; ?>);" class="btn btn-sm btn-danger">
                                <i class="fas fa-times"></i>
                            </a>
                            <a title="Add Attende" href="{{route('addAttendee',['id'=>$event['id']])}}"  class="btn btn-sm btn-success">
                                <i class="fas fa-plus"></i>
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

@endsection

@section('page-script')
<script>
    $(document).ready(function () {
        $('#eventTable').DataTable();
    });
</script>
@endsection

