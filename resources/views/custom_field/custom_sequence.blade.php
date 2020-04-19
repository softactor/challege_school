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
							 @can('custom_fields_add')
							     <li><a href="{{url('custom_field/add')}}">{{ _i('Add Custom Field') }}</a></li>
							 @endcan
							 <li class="active"><a href="{{url('custom_field/sequence')}}">{{ _i('Manage Sequence') }}</a></li>
						</ul>
					</div>
				</div>
			</div>
			
            <div class="row">
				<div class="col-lg-12">
					<div class="row">
						<div class="col-lg-12">
							<div class="panel panel-default">
								<div class="panel-heading">
									{{_i('Change Sequence')}}
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-6">
											<div class="form-group">
													<label>{{ _i('Module Name') }}<span class="text-danger">*</span></label>
													<select class="form-control module" name="module_name">
														<option value="">{{_i('Select Module')}}</option>
														@foreach($allModules as $k => $v)
															<option value="{{$k}}" {{ old('module_name') ? 	'selected' : '' }}  > {{_i($v)}}</option>
														@endforeach
													</select>
													<br>
													<button class="btn btn-info" id="go" type="button" >Go</button>
													@if ($errors->has('module_name'))
														<span class="invalid-feedback">
															 <strong>{{ $errors->first('module_name') }}</strong>
														</span>
													@endif
											</div>
											<div class="module_seq">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>  
@endsection
@section('page-script')
<script>
	$(document).ready(function() {
		$('body').on('change', '.module', function(){
			$('.module_seq').empty();
			
		});
		$('body').on('click', '#go', function(){
			
				$('.module_seq').empty();
				var module_id = $('.module').val()
				var data = {
					module: module_id,
				}
				
				$.ajax({
					type: 'POST',
					url: "{{route('add_sequence')}}",
					headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
					data : data,
					success: function (response)
					{	
						
						$('.module_seq').append(response);
						
							var module = '#module'+module_id;
							
							$(module).sortable({
								stop:function(event,ui){
								var seq_support = $(module).sortable("toArray");	
									
								$.ajax({	
									type: 'POST',
									url: "{{URL::to('getCustomSequence')}}",
									headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
									data : {seq:seq_support,module_id:module_id},		
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
							});
						
					},
					error: function(e) 
					{
						alert("An error occurred: " + e.responseText);
						console.log(e);
					}
				});
		});
	});
</script>
@endsection
