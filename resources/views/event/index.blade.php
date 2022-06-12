@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-block">
                <div class="row">
                    <div class="col-md-6">
                        <h4 class="card-title">Event List</h4>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="{{route('importEventCSV')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Import Events
                            </button>
                        </a>
                        <a href="{{route('add_event')}}">
                            <button type="button" class="btn btn-rounded btn-info">
                                <span class="btn-icon-left text-info">
                                    <i class="fa fa-list color-info"></i>
                                </span>Add Event
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
                    <table id="example3" class="display" style="min-width: 845px">
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
                                    <div class="text-center">
                                        <a title="Edit" href="{{route('editEvent',[$event['id']])}}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                        <a title="Delete" href="javascript:void(0)" onclick="deletConfirmation('<?php echo $del_url; ?>',<?php echo $del_id; ?>);" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fa fa-trash"></i></a>
                                        <a title="Add Attende" href="{{route('addAttendee',['id'=>$event['id']])}}" class="btn btn-success shadow btn-xs sharp"><i class="fa fa-plus"></i></a>
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