@extends('layouts.app')
@section('css')
<style>
.help-block span{
	color:#FF0000;
}
</style>
@endsection

@section('content')
	<form method="post" action="{{ route('saveAttendee') }}">
		{{  @csrf_field() }}
		@method('POST')
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Add Attendee</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Serial Number</label>
						<input type="text" name="serial_number" value="{{ $serial_number }}" readonly="true" class="form-control">
						@if ($errors->has('serial_number')) 
							<span class="help-block">
								<span>{{ $errors->first('serial_number') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Event</label>
						<input type="hidden" value="{{ $event_id }}" name="event_id">
						<select class="form-control" disabled>
							<option value=''>-- Select Event --</option>
							@if ($events->count())
								@foreach($events as $key=>$value)
									<option value="{{ $key }}" {{ $event_id == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
								@endforeach
							@endif
						</select>
						@if ($errors->has('event_id')) 
							<span class="help-block">
								<span>{{ $errors->first('event_id') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Salutation</label>
						<input type="text" name="salutation" value="{{ old('salutation') }}" class="form-control">
						@if ($errors->has('salutation')) 
							<span class="help-block">
								<span>{{ $errors->first('salutation') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control">
						@if ($errors->has('first_name')) 
							<span class="help-block">
								<span>{{ $errors->first('first_name') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
						@if ($errors->has('last_name')) 
							<span class="help-block">
								<span>{{ $errors->first('last_name') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" value="{{ old('email') }}" class="form-control">
						@if ($errors->has('email')) 
							<span class="help-block">
								<span>{{ $errors->first('email') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>User Type</label>
						<select class="form-control" name="type_id">
							<option value=''>-- Select Type --</option>
							@if ($userTypes->count())
								@foreach($userTypes as $key=>$value)
									<option value="{{ $key }}" {{ old('type_id') == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
								@endforeach
							@endif
						</select>
						@if ($errors->has('type_id')) 
							<span class="help-block">
								<span>{{ $errors->first('type_id') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Country</label>
						<input type="text" name="country" value="{{ old('country') }}" class="form-control">
						@if ($errors->has('country')) 
							<span class="help-block">
								<span>{{ $errors->first('country') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Company</label>
						<input type="text" name="company" value="{{ old('country') }}" class="form-control">
						@if ($errors->has('company')) 
							<span class="help-block">
								<span>{{ $errors->first('company') }}</span>
							</span>
						@endif
					</div>
					<hr>
					
					<!-- Custom Fields Data -->
					@if(count(json_decode($CustomFields)) > 0)
							<div class="panel panel-default custom_field_data">
								<div class="panel-heading">
									Other Information
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-lg-12">
											@foreach(json_decode($CustomFields) as $custom_field)
						<?php
							$exa = explode('|',$custom_field->field_validation);
							  $min = "";
							  $max = "";
							  $required = "";
							  $red = "";
							  $limit_value_min = "";
							  $limit_value_max = "";
							  $numeric = "";
							  $alpha = "";
							  $alpha_num = "";
							  $email = "";
							  $url = "";
							  $image = "";
							  $minDate="";
							  $maxDate="";
							  foreach($exa as $key=>$value)
								 {
									if (strpos($value, 'min') !== false)
										{
										   $min = $value;
										   $limit_value_min = substr($min,4);
										}
										elseif(strpos($value, 'max') !== false)
										{
										   $max = $value;
										   $limit_value_max = substr($max,4);
										}
										elseif(strpos($value, 'required') !== false)
										{
											$required="required";
											$red="*";
										}
										elseif(strpos($value, 'numeric') !== false)
										{
											$numeric="numeric";
										}
										elseif($value == 'alpha')
										{
											$alpha="alpha";
										}
										elseif(strpos($value, 'alpha_num') !== false)
										{
											$alpha_num="alpha_num";
										}
										elseif(strpos($value, 'email') !== false)
										{
											$email = "email";
										}
										elseif(strpos($value, 'image') !== false)
										{
											$image = "image";
										}
										elseif(strpos($value, 'url') !== false)
										{
											$url="url";
										}
											elseif(strpos($value, 'after_or_equal:today') !== false )
										{
											$minDate=1;
										}
										elseif(strpos($value, 'date_equals:today') !== false )
										{
											$minDate=$maxDate=1;
										}
										elseif(strpos($value, 'before_or_equal:today') !== false)
										{	
											$maxDate=1;
										}

								 }
							$data = 'custom.'.$custom_field->id;
							$datas = 'custom.'.$custom_field->id;
							
						?>
						
						<div class="form-group role_{{ $custom_field->module }} bydefault_hide form-group" style="margin-top:13px;">
							<label class="control-label">{{ ucwords(trans($custom_field->field_label)) }}<span class="text-danger">&nbsp;{{ $red }}</span></label>
							<div>
							@if($custom_field->field_type =='text')
								<input class="form-control error hideattar{{$custom_field->module}}" type="text" it-required="{{$required}}" name="custom[{{ $custom_field->id }}]" value="{{ old($data) }}" id="{{$custom_field->id}}"  minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}" value="{{ old('custom['.$custom_field->id.']') }}" maxlength="{{$limit_value_max}}">
							
								<span class="help-block">
									<span class="errmsg{{$custom_field->id}}"></span>
								</span>
								@if ($errors->has($data))
								<span class="help-block">
									<span>{{ $errors->first($data) }}</span>
								</span>
								@endif
								
								@elseif($custom_field->field_type =='textarea')
								<textarea class="form-control error hideattar{{$custom_field->module}}" name="custom[{{ $custom_field->id }}]" rows="2" it-required="{{$required}}" id="{{$custom_field->id}}" minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}" maxlength="{{$limit_value_max}}">{{ old($datas) }}</textarea>
								<span class="help-block">
									<span class="errmsg{{$custom_field->id}}"></span>
								</span>
								@if ($errors->has($data))
								<span class="help-block">
									<span>{{ $errors->first($data) }}</span>
								</span>
								@endif
								@elseif($custom_field->field_type =='date')
								<input class="form-control error custom_datepicker hideattar{{$custom_field->module}}" name="custom[{{ $custom_field->id }}]" value="{{ old('custom['.$custom_field->id.']') }}" it-required="{{$required}}" value="{{ old($data) }}" id="{{$custom_field->id}}" minDate="{{$minDate}}"  maxDate="{{$maxDate}}"label="{{$custom_field->field_label}}" images="{{$image}}">
								<span class="help-block">
									 <span class="errmsg{{$custom_field->id}}"></span>
								</span>
								@if ($errors->has($data))
								<span class="help-block">
									<span>{{ $errors->first($data) }}</span>
								</span>
								@endif
								@elseif($custom_field->field_type =='dropdown')
								<select class="form-control error hideattar{{$custom_field->module}}" name="custom[{{ $custom_field->id }}]" it-required="{{$required}}" id="{{$custom_field->id}}" minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}">
									@foreach ($option as $options)
										<option value="{{ $options->option_label }}" @if (old($datas) == $options->option_label) selected="selected" @endif>{{ ucwords(trans($options->option_label)) }}</option>
									@endforeach
								</select>
								<span class="help-block">
									 <span class="errmsg{{$custom_field->id}}"></span>
								</span>
								@if ($errors->has($data))
								<span class="help-block">
									 <span>{{ $errors->first($data) }}</span>
								</span>
								@endif
								@elseif($custom_field->field_type =='checkbox')
								<div class="">
									
										@foreach ($option as $options)
										 <label class="checkbox-inline">
											<input type="checkbox" class="hideattar{{$custom_field->module}} error" name="custom[{{ $custom_field->id }}][]" value="{{ $options->option_label }}" it-required="{{$required}}"  minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" {{ (is_array(old($datas)) and in_array($options->option_label, old($datas))) ? ' checked' : '' }}  images="{{$image}}"> {{ $options->option_label }}
										</label>
										@endforeach
									
								</div>
								<span class="help-block">
									 <span class="errmsg{{$custom_field->id}}"></span>
								</span>
								@if ($errors->has($data))
								<span class="help-block">
									 <span>{{ $errors->first($data) }}</span>
								</span>
								@endif
								
								@elseif($custom_field->field_type == 'radio')
								<div class="">
									@foreach ($option as $options)
									 <label class="radio-inline">
										<input type="radio" class="hideattar{{$custom_field->module}} error" name="custom[{{ $custom_field->id }}]" value="{{ $options->option_label }}" it-required="{{$required}}" id="{{$custom_field->id}}" minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}" @if (old($datas) == $options->option_label) {{ 'checked' }} @endif > {{ $options->option_label }}
									</label>
									@endforeach
								</div>
								<span class="help-block">
									 <span class="errmsg{{$custom_field->id}}"></span>
								</span>
								@if ($errors->has($data))
								<span class="help-block">
									 <span>{{ $errors->first($data) }}</span>
								</span>
								@endif	
							
							@elseif($custom_field->field_type == 'file')
								<input class="form-control error hideattar{{$custom_field->module}}" type="file" it-required="{{$required}}" name="custom[{{ $custom_field->id }}]" value="{{ old($data) }}" id="{{$custom_field->id}}"  minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}" value="{{ old('custom['.$custom_field->id.']') }}">
							
								<span class="help-block">
									<span class="errmsg{{$custom_field->id}}"></span>
								</span>
								@if ($errors->has($data))
								<span class="help-block">
									<span>{{ $errors->first($data) }}</span>
								</span>
								@endif
							@endif
						</div>
					</div>
					@endforeach  
										</div>
									</div>
								</div>
							</div>
					@endif
					<div class="form-group">
						<input type="submit" class="btn btn-success" value="Submit">
					</div>
				</div>
			</div>
		</div>
	</form>
@endsection

@section('page-script')
<script>
//custom field datepicker
$(document).ready(function(){
	$(".custom_datepicker").each(function( key, value ) {
		
		var id=$(this).attr('id');
		var minDate=$(this).attr('minDate');
		var maxDate=$(this).attr('maxDate');
		
		var minDate1=new Date()
		var maxDate1=new Date()
		
		if(minDate=='1' && maxDate=='1'){
			
			
			
			$('#'+id).datetimepicker({
				
				minDate:minDate1,
				maxDate:maxDate1,
				icons: {
					
					previous: 'glyphicon glyphicon-backward',
					next: 'glyphicon glyphicon-forward',
					
				},
			
			});
			
		}else if(minDate=='1'){
			
			
			
			$('#'+id).datetimepicker({
				
				minDate:minDate1,
				icons: {
					
					previous: 'glyphicon glyphicon-backward',
					next: 'glyphicon glyphicon-forward',
					
				},
			
			});
			
		}else if(maxDate=='1'){
			
			
			
			$('#'+id).datetimepicker({
				
				maxDate:maxDate1,
				icons: {
					
					previous: 'glyphicon glyphicon-backward',
					next: 'glyphicon glyphicon-forward',
					
				},
			});
		
		}else{
		
			$('#'+id).datetimepicker({
				icons: {
					
					previous: 'glyphicon glyphicon-backward',
					next: 'glyphicon glyphicon-forward',
					
				},
			
			});
		
		}
	  
	});
});
</script>
@endsection