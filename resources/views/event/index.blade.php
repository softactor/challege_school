@extends('layouts.app')
@section('css')
<style>

</style>
@endsection

@section('content')
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading">Event List</div>
				<div class="panel-body">
					<table class="table table-bordered" id="eventTable">
						<thead>
							<tr>
								<th>Serial Number</th>
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
								<td><a href="{{route('addAttendee',['id'=>$event['id']])}}"  class="btn btn-sm btn-success">Add Attendee</a></td>
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
$(document).ready( function () {
    $('#eventTable').DataTable();
} );
</script>
@endsection

