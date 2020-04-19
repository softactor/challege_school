@extends('layouts.app')
@section('css')
<style>

</style>
@endsection
@section('content')
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<a href="{{ url('custom_field/add') }}"  class="btn btn-sm btn-success">Add Custom Fields</a>
		</div>
		<div class="panel-body">
			<table width="100%" id="dataTables-example" class="dataTables-example1 table table-striped table-bordered responsive">
				<thead>
					<tr>
						<th>#</th>
						<th>Module Name</th>
						<th>Label</th>
						<th>Type</th>
						<th>Validation</th>
						<th>Visibility</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $i=1; ?>
					@foreach($custom as $custom)
						<tr class="odd gradeX">
							<td>{{ $i }}</td>
							<td>{{ $custom->module }}</td>
							<td>{{ $custom->field_label }}</td>
							<td>{{ $custom->field_type }}</td>
							<td>{{ $custom->field_validation }}</td>
							<td>
								<label class="switch">
									<input id="visable" mod_id="{{$custom->id}}" data-toggle="toggle" type="checkbox" @if($custom->field_visibility == 1){{ 'checked' }}@endif>
									<span class="slider round"></span>
								</label>
							</td>
							<td width="15%">
								<a href="{{ url('custom_field/edit/'.$custom->id)}}" class="btn btn-sm btn-success">Edit</a>
								<a href="{{ url('custom_field/destroy/'.$custom->id)}}" onclick="return confirm('Are you sure you want to delete this custom field?');" class="btn btn-sm btn-danger sa-warning">Delete</a>
							</td>
						</tr>
						@php $i++; @endphp
					@endforeach	
				</tbody>
			</table>
		</div>
	</div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('body').on('click', '#visable', function() 
		{
				if($(this).prop("checked") == true)
				{
					var mod_id = $(this).attr('mod_id');
					var value = 1;
					$.ajax({
							type: 'GET',
							url: '{{URL::to('custom_visibility')}}',
							data : {mod_id:mod_id,value:value},
							success: function (response)
							{		
							},
							error: function(e) 
							{
								alert("An error occurred: " + e.responseText);
								console.log(e);
							}
					});
				}
				else if($(this).prop("checked") == false)
				{
					var mod_id = $(this).attr('mod_id');
					var value = 0;
					$.ajax({
							type: 'GET',
							url: '{{URL::to('custom_visibility')}}',
							data : {mod_id:mod_id,value:value},
							success: function (response)
							{	
							},
							error: function(e) 
							{
								alert("An error occurred: " + e.responseText);
								console.log(e);
							}
					});
				}
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
             responsive: true,
        });
    });
</script>
<script>
$('body').on('click', '.sa-warning', function(){
	  var url =$(this).attr('url');
        swal({   
            title: "Are You Sure?",
			text: "You will not be able to recover this data afterwards!",   
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#297FCA",   
            confirmButtonText: "Yes, delete!",   
            closeOnConfirm: false 
        }, function(){
			window.location.href = url;
        });
    }); 
</script>
@endsection
