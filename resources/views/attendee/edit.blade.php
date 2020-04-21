@extends('layouts.app')
@section('css')
<style>
.help-block span{
	color:#FF0000;
}
</style>
@endsection

@section('content')
	<form method="post" action="{{ route('updateAttendee', [$row->id]) }}">
		{{  @csrf_field() }}
		@method('POST')
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Edit Attendee</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Serial Number</label>
						<input type="text" name="serial_number" value="{{ $row->serial_number }}" readonly="true" class="form-control">
						@if ($errors->has('serial_number')) 
							<span class="help-block">
								<span>{{ $errors->first('serial_number') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Event</label>
						<input type="hidden" name="event_id" value="{{$row->event_id}}">
						<select class="form-control" disabled>
							<option value=''>-- Select Event --</option>
							@if ($events->count())
								@foreach($events as $key=>$value)
									<option value="{{ $key }}" {{ $row->event_id == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
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
						<select class="form-control" name="salutation">
                                                    <option value=''>-- Select Salutation --</option>
                                                    @if ($salutations->count())
                                                            @foreach($salutations as $salutation)
                                                            <option value="{{ $salutation->name }}"<?php if(isset($row->salutation) && $row->salutation == $salutation->name){ echo 'selected'; } ?>>{{ $salutation->name }}</option>
                                                            @endforeach
                                                    @endif
                                                </select>
						@if ($errors->has('salutation')) 
							<span class="help-block">
								<span>{{ $errors->first('salutation') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="first_name" value={{ $row->first_name }} class="form-control">
						@if ($errors->has('first_name')) 
							<span class="help-block">
								<span>{{ $errors->first('first_name') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="last_name" value={{ $row->last_name }} class="form-control">
						@if ($errors->has('last_name')) 
							<span class="help-block">
								<span>{{ $errors->first('last_name') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="email" value={{ $row->email }} class="form-control">
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
									<option value="{{ $key }}" {{ $row->type_id == $key ? 'selected="selected"' : '' }}>{{ $value }}</option>
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
						<select class="form-control" name="country">
                                                    <option value=''>-- Select Country --</option>
                                                    @if ($events->count())
                                                            @foreach($countries as $country)
                                                            <option value="{{ $country->country_name }}" <?php if(isset($row->country) && $row->country == $country->country_name){ echo 'selected'; } ?>>{{ $country->country_name }}</option>
                                                            @endforeach
                                                    @endif
                                                </select>
                                                @if ($errors->has('country')) 
							<span class="help-block">
								<span>{{ $errors->first('country') }}</span>
							</span>
						@endif
					</div>
					
					<div class="form-group">
						<label>Company</label>
						<input type="text" name="company" value={{ $row->company }} class="form-control">
						@if ($errors->has('company')) 
							<span class="help-block">
								<span>{{ $errors->first('company') }}</span>
							</span>
						@endif
					</div>
					
					@if(count(json_decode($customFields,true)) > 0)
			<div class="panel panel-default custom_field_data">
				<div class="panel-heading">
					Other Information
				</div>
				<div class="panel-body">
							@foreach(json_decode($customFields) as $custom_field)
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
											elseif(strpos($value, 'url') !== false)
											{
												$url="url";
											}
											elseif(strpos($value, 'image') !== false)
											{
												$image="image";
											}
									 }
								$data = 'custom.'.$custom_field->id;
								$datas = 'custom.'.$custom_field->id;
								
								$custom_values = getCustomFieldValue("attendee",$row->id,$custom_field->id);
								
								?>
							<div class="role_{{ $custom_field->module }} bydefault_hide " style="margin-top:20px;">
							<div class="form-group">
							<label class="right_in">{{ ucwords(trans($custom_field->field_label)) }}<span class="text-danger">&nbsp;{{ $red }}</span></label>
							<div>
								@if($custom_field->field_type =='text')
								<input class="form-control error hideattar{{$custom_field->module}}" type="text" it-required="{{$required}}" name="custom[{{ $custom_field->id }}]" value="{{ $custom_values }}" id="{{$custom_field->id}}"  minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}" maxlength="{{$limit_value_max}}">
								<span class="help-block">
								<span class="errmsg{{$custom_field->id}}"></span>
								</span>
								@if ($errors->has($data))
								<span class="help-block">
								<span>{{ $errors->first($data) }}</span>
								</span>
								@endif
								@elseif($custom_field->field_type =='textarea')
								<textarea class="form-control error hideattar{{$custom_field->module}}" name="custom[{{ $custom_field->id }}]" rows="2" it-required="{{$required}}" id="{{$custom_field->id}}" minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}" maxlength="{{$limit_value_max}}">{{ $custom_values }}</textarea>
								<span class="help-block">
								<span class="errmsg{{$custom_field->id}}"></span>
								</span>
								@if ($errors->has($data))
								<span class="help-block">
								<span>{{ $errors->first($data) }}</span>
								</span>
								@endif	
								@elseif($custom_field->field_type =='date')
								<input class="form-control custom_datepicker error hideattar{{$custom_field->module}}"  name="custom[{{ $custom_field->id }}]" value="{{ $custom_values }}" it-required="{{$required}}" id="{{$custom_field->id}}" label="{{$custom_field->field_label}}">
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
								<option value="{{ $options->option_label }}" @if ($custom_values == $options->option_label) selected="selected" @endif>{{ ucwords(trans($options->option_label)) }}</option>
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
								@php
								$validation = explode(",",$custom_values);
								@endphp
								<div class="">
									@foreach ($option as $options)
									<label class="checkbox-inline">
									<input type="checkbox" class="hideattar{{$custom_field->module}} error" name="custom[{{ $custom_field->id }}][]" value="{{ $options->option_label }}" it-required="{{$required}}" id="{{$custom_field->id}}" minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}" @if(in_array($options->option_label,$validation)){{'checked'}}@endif > {{ $options->option_label }}
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
								@elseif($custom_field->field_type =='radio')
								<div class="">
									@foreach ($option as $options)
									<label class="radio-inline">
									<input type="radio" class="hideattar{{$custom_field->module}} error" name="custom[{{ $custom_field->id }}]" value="{{ $options->option_label }}" it-required="{{$required}}" id="{{$custom_field->id}}" minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}" {{
									($options->option_label == $custom_values)?'checked':''}} > {{ $options->option_label }}
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
								@elseif($custom_field->field_type =='file')
								<input type="file" class="form-control error hideattar{{$custom_field->module}}" name="custom[{{ $custom_field->id }}]" rows="2" it-required="{{$required}}" id="{{$custom_field->id}}" minn="{{$min}}" maxx="{{$max}}" lim_min={{$limit_value_min}} lim_max="{{$limit_value_max}}" num="{{$numeric}}" label="{{$custom_field->field_label}}" email="{{$email}}" alpha="{{$alpha}}" alpha_num="{{$alpha_num}}" url="{{$url}}" images="{{$image}}">
								<img src=" {{ asset('public/user/'.$custom_values) }}" class="img-circle" style="margin-top:5px;" width="50px" height="50px">
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
						</div>
						@endforeach
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