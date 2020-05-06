@extends('layouts.app')
@section('css')
<style>

</style>
@endsection

@section('content')
	<div class="col-lg-12">
		<div class="panel panel-default">
			<div class="panel-heading"><a href="{{route('createTemplate')}}"  class="btn btn-sm btn-success">Add Template</a></div>
				<div class="panel-body">
					<table class="table table-bordered list-table-custom-style" id="templateTable">
						<thead>
							<tr>
								<th>Serial Number</th>
								<th>Template Name</th>
								<th>Event</th>
								<th>Type</th>
								<th>Page Height</th>
								<th>Page Width</th>
								<th>Action</th>
							</tr>					
						</thead>
						<tbody>
							@php $i = 1 @endphp
							@foreach($templates as $template)
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $template->template_name }} (ID - {{$template->id }})</td>
								<td>{{ getEventName($template->event_id) }}</td>
								<td>{{ getTypeName($template->type_id) }}</td>
								<td>{{ $template->page_height." MM"}}</td>
								<td>{{ $template->page_width." MM" }}</td>
								<td>
                                                                    <a title="Delete Configuration" href="{{route('deleteTemplate',[$template->id])}}" onclick="return confirm('Are you sure you want to delete this template?');" class="btn btn-sm btn-danger">
                                                                        <i class="fa fa-times"></i>
                                                                    </a>
                                                                    <a href="{{route('designTemplate',[$template->id])}}"  class="btn btn-sm btn-success" title="Design Template">
                                                                        <i class="fas fa-palette"></i>
                                                                    </a>
                                                                    <a title="Edit Configuration" href="{{route('editTemplate',[$template->id])}}"  class="btn btn-sm btn-success">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <a title="Export Template Configuration" href="{{route('exportTemplate',[$template->id])}}"  class="btn btn-sm btn-success">
                                                                        <i class="fas fa-file-export"></i>
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
$(document).ready( function () {
    $('#templateTable').DataTable();
} );
</script>
@endsection

