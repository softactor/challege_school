@extends('layouts.app')
@section('content')
<style>
.panel-body>ul { list-style-type: none; margin: 0; padding: 0; width: 60%; }
.ui-state-default  { border: 1px solid #c5c5c5;
    background: #f6f6f6;
    font-weight: normal;
    color: #454545;
	padding:5px;
	margin-bottom:5px;
}
.sort-custom{
	padding:5px;
}
</style>

<script src="{{URL::asset('public/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{ URL::asset('public/plugins/js/jquery-ui.js')}}"></script>

		<div class="row">
				<div class="col-lg-12">
					<h1 class="page-header">{{ _i('Custom Field') }}</h1>
				</div>          <!-- /.col-lg-12 -->
		</div>

			<div class="row">
                <div class="col-lg-12">
					<div class="nav-body">
						 <ul class="nav nav-tabs">
							 <li><a href="{{url('custom_field')}}">{{ _i('Custom Field') }}</a></li>
							 <li class="active"><a href="{{url('custom_field/sequence')}}">{{ _i('Manage Sequence') }}</a></li>
						</ul>
					</div>
				</div>
			</div>
			
            <div class="row">
				<div class="col-lg-12">
					<div class="row">
					@foreach($modules as $module)
						<div class="col-lg-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									{{$module->cate_name}}
								</div>
								<div class="panel-body">
									<ul id="module{{$module->id}}">
										@foreach($customs as $custom)
											@if($module->id == $custom->module)
												<li class="ui-state-default" id="{{$custom->id}}"><i class="fa fa-sort sort-custom" aria-hidden="true"></i>{{ $custom->field_label }}</li>
											@endif	
										@endforeach	
									</ul>
								</div>
							</div>
						</div>
						<script>
							var module = '#module'+'{{$module->id}}';
							var seq{{$module->id}} = $(module);
							seq{{$module->id}}.sortable({
							stop:function(event,ui){
							var seq_support = seq{{$module->id}}.sortable("toArray");
							console.log(seq_support)
									$.ajax({
											type: 'POST',
											url: '{{URL::to('getCustomSequence')}}',
											headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
											data : {seq:seq_support,module_id:{{$module->id}}},
											success: function (response)
											{	
													// alert(response);
											},
											error: function(e) 
											{
													alert("An error occurred: " + e.responseText);
													console.log(e);
											}
										});
								}
							})	
						</script>
					@endforeach	
					</div>
				</div>
			</div>  
@endsection
