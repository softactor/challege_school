@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header d-block">
				<div class="row">
					<div class="col-md-3">
						<h4 class="card-title">Template List</h4>
					</div>
					<div class="col-md-9 text-right">

						<a href="{{route('createTemplate')}}">
							<button type="button" class="btn btn-rounded btn-info">
								<span class="btn-icon-left text-info">
									<i class="fa fa-list color-info"></i>
								</span>Template Add
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
					<table id="templateTable" class="display" style="min-width: 845px">
						<thead>
							<tr>
								<th>#</th>
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
									<div class="d-flex">
										<a title="Delete Configuration" href="{{route('deleteTemplate',[$template->id])}}" onclick="return confirm('Are you sure you want to delete this template?');" class="btn btn-danger shadow btn-xs sharp mr-1">
											<i class="fa fa-times"></i>
										</a>
										<a href="{{route('designTemplate',[$template->id])}}" class="btn btn-success shadow btn-xs sharp mr-1" title="Design Template">
											<i class="fa fa-picture-o"></i>
										</a>
										<a title="Edit Configuration" href="{{route('editTemplate',[$template->id])}}" class="btn btn-primary shadow btn-xs sharp mr-1">
											<i class="fa fa-edit"></i>
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
		$('#templateTable').DataTable({
			language: {
				paginate: {
					next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
					previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
				}
			}
		});
	});
</script>
@endsection