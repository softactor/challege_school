@extends('layouts.app')
@section('css')
<style>
.help-block span{
	color:#FF0000;
}
</style>
@endsection

@section('content')
	<form method="post" id="my-form" action="update/{{$editid}}">
		@csrf
		@method('POST')
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Add Custom Field</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Module Name</label>
						<select class="form-control" name="module_name" readonly>
							<option value="">Select Module</option>
							<option value="attendee" @if($custom->module=='attendee'){{'selected'}}@endif >Attendee</option>
						</select>
					</div>
										
					<div class="form-group">
						<label>Label</label>
						<input class="form-control" type="text" name="label" value="{{ $custom->field_label }}">
						@if ($errors->has('label'))
							<span class="help-block">
								 <span>{{ $errors->first('label') }}</span>
							</span>
						@endif
					</div>
										
					<div class="form-group">
						<label>Type</label>
						 <select class="form-control dropdown_change" name="type" readonly>
							<option value="">Select Input Type</option>
							<option value="text" @if($custom->field_type=='text'){{'selected'}}@endif >Text Box</option>
							<option value="textarea" @if($custom->field_type=='textarea'){{'selected'}}@endif >Textarea</option>
							<option value="dropdown" @if($custom->field_type=='dropdown'){{'selected'}}@endif >Dropdown</option>
							<option value="date" @if($custom->field_type=='date'){{'selected'}}@endif >Date Field</option>
							<option value="checkbox" @if($custom->field_type=='checkbox'){{'selected'}}@endif >Checkbox</option>
							<option value="radio" @if($custom->field_type=='radio'){{'selected'}}@endif >Radio</option>
							<!--<option value="file" @if($custom->field_type=='file'){{'selected'}}@endif >File</option>-->
						 </select>
					</div>
									
										<div class="form-group">
                                            <label>Validation</label>
                                            <div class="checkbox">
												@php 
										$validation = explode("|",$custom->field_validation);
										$min = "";
										$max = "";
										$mimes = "";
										foreach($validation as $key=>$value)
										{
											if (strpos($value, 'min') !== false)
											{
												$min = $value;
											}
											elseif(strpos($value, 'max') !== false)
											{
												$max = $value;
											}
											elseif(strpos($value, 'mimes') !== false)
											{
												$mimes = $value;
											}
										}
										$exa = $custom->field_validation;
										$max_find = $max;
										$min_find = $min;
										$mimes_find = $mimes;
										$limit_max = substr($max_find,0,3);
										$limit_min = substr($min_find,0,3);
										$limit_mimes = substr($mimes_find,0,6);
										$limit_value_max = substr($max_find,4);
										$limit_value_min = substr($min_find,4);
										$limit_value_mimes = substr($mimes_find,6);
										if($custom->field_type == 'dropdown' || $custom->field_type == 'checkbox' || $custom->field_type == 'radio'  ){
											$Tclass="disabled";
											$Dclass="disabled";
										}else if($custom->field_type == 'text' || $custom->field_type=='textarea'){
											$Dclass="disabled";
											$Tclass=NULL;
										}else if($custom->field_type == 'date'){
											$Tclass="disabled";
											$Dclass=NULL;
										}
										else if($custom->field_type == 'file'){
											$Tclass=NULL;
											$Dclass="disabled";
										}
									@endphp
												<label class="checkbox-inline">
                                                    <input type="checkbox" name="validation[]"  value="nullable" class="nullable_rule" @if(in_array("nullable",$validation)){{'checked'}}@endif>Nullable
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="validation[]" value="required" @if(in_array("required",$validation)){{'checked'}}@endif class="required_rule">Required
                                                </label>
												
												<label class="checkbox-inline">
                                                    <input class="only_number" {{$Tclass}}  type="checkbox" name="validation[]" value="numeric" @if(in_array("numeric",$validation)){{'checked'}}@endif>Only Number
                                                </label>
												
												<label class="checkbox-inline">
                                                    <input  class="only_char" {{$Tclass}}  type="checkbox" name="validation[]" value="alpha" @if(in_array("alpha",$validation)){{'checked'}}@endif>Only Character
                                                </label>
												<label class="checkbox-inline">
                                                    <input class="char_space" {{$Tclass}}  type="checkbox" name="validation[]" value="alpha_space" @if(in_array("alpha_space",$validation)){{'checked'}}@endif>Character with Space
                                                </label>
												<label class="checkbox-inline">
                                                    <input class="char_num" {{$Tclass}}  type="checkbox" name="validation[]" value="alpha_num" @if(in_array("alpha_num",$validation)){{'checked'}}@endif>Number & Character
                                                </label>
												<label class="checkbox-inline">
                                                    <input class="email" {{$Tclass}}  type="checkbox" name="validation[]" value="email" @if(in_array("email",$validation)){{'checked'}}@endif>Email
                                                </label>
												
												<label class="checkbox-inline">
													<input type="checkbox" {{$Tclass}} name="validation[]"  class="opentext max" id="max_value" max_attr="max" 
													value="<?php if (strpos($max_find, 'max') !== false) { echo $max_find; }?>" <?php if (strpos($max_find, 'max') !== false) {echo 'checked'; }?>>Maximum
												</label>
												
												<label class="checkbox-inline">
													<input type="checkbox" {{$Tclass}} name="validation[]" class="opentext min" id="min_value" max_attr="min" 
													value="<?php if (strpos($min_find, 'min') !== false) { echo $min_find; } ?>" <?php if (strpos($min_find, 'min') !== false) {echo 'checked'; }?>>Minimum
												</label>
												<label class="checkbox-inline">
                                                    <input class="url" {{$Tclass}} type="checkbox" name="validation[]" value="url" @if(in_array("url",$validation)){{'checked'}}@endif>URL
                                                </label>
												<label class="checkbox-inline">
												    <input type="checkbox" {{$Dclass}} name="validation[]" {{ (in_array('before_or_equal:today',$validation)) ? 	'checked' : '' }} id="date0"  value="before_or_equal:today"  >Before Or Equal(Today's Date)
												</label>
												<label class="checkbox-inline">
													<input id="date1" type="checkbox" {{$Dclass}}  name="validation[]"  {{ (in_array('date_equals:today',$validation)) ? 	'checked' : '' }}   value="date_equals:today" >Today's Date
												</label>
												<label>
												<input id="date2" type="checkbox" {{$Dclass}} {{ (in_array('after_or_equal:today',$validation)) ? 	'checked' : '' }}name="validation[]" value="after_or_equal:today" >After Or Equal(Today's Date
												</label>
												<label>
													<input type="checkbox" {{$Tclass}} max_attr="mimes" name="validation[]" id="image" class="opentext image" value="<?php if (strpos($mimes_find, 'mimes') !== false) { echo $mimes_find; } ?>" <?php if (strpos($mimes_find, 'mimes') !== false) {echo 'checked'; }?>>File Extension
												</label>
                                            </div>
                                        </div>  
										@if(strpos($mimes_find, 'mimes') !== false)
											<div class="form-group" id="file_extension" style="display:block;">
												<label>{{ ('File Extension') }}</label>
													<input type="text" class="form-control mimes" id="file_extension_filed" value="{{ $limit_value_mimes }}" style="text-transform:uppercase">
													<label>Note: use comma seprated value(',') in between two diffrent formates  Like:(JPEG,PNG,DOXS)</label>
											</div>
											@else							
											<div class="form-group" id="file_extension" style="display:none;">
												<label>{{ ('File Extension:') }}</label>
												
													<input type="text" class="form-control mimes" id="file_extension_filed" value="" style="text-transform:uppercase">
													<label>Note: use comma seprated value(',') in between two diffrent formates  Like:(JPEG,PNG,DOXS)</label>
												
											</div>
											@endif
										@if(strpos($max_find, 'max') !== false)
										<div class="form-group" id="max_limit" style="display:block">
											<label class="change_max">Maximum Limit:</label>
											<input type="text" class="form-control"  id="max" value="{{ $limit_value_max }}">
										</div>
										@else
											<div class="form-group" id="max_limit" style="display:none">
											<label class="change_max">Maximum Limit:</label>
											<input type="text" class="form-control"  id="max" value="">
										</div>
										@endif
										
										@if(strpos($min_find, 'min') !== false)
										<div class="form-group" id="min_limit" style="display:block">
											<label class="change_min">Minimum Limit:</label>
											<input type="text" class="form-control" id="min" value="{{ $limit_value_min }}">
										</div>
										@else
											<div class="form-group" id="min_limit" style="display:none">
											<label class="change_min">Minimum Limit:</label>
											<input type="text" class="form-control" id="min" value="">
										</div>
										@endif
                                </div>
                            </div>
                     </div>
					 <button type="submit" class="btn btn-success">Update</button>
                  </div>
				 </form>
		
<script>			
$(document).ready(function(){
	
	$('body').on('click','.image',function(){
		if($(this).prop("checked") == true)
		{
			$('.only_char,.char_space,.char_num,.email,.url,.date,.only_number').attr('disabled',true);
			$('.change_max').html('Maximum Size of File(KB)');
			$('.change_min').html('Minimum Size of File(KB)');	
	   
	   }else{
			
			$('.only_char,.char_space,.char_num,.email,.url,.date,.only_number').attr('disabled',false);
			$('.change_max').html('Maximum Limit');
			$('.change_min').html('Minimum Limit');
		}
	});
	
	<!-- Make checked required or nullable code start -->
	$('body').on('click', '.required_rule', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.nullable_rule').prop('checked', false);
		}else{
			$('.nullable_rule').prop('checked', true);
		}
	});
	//Date
	
	$('body').on('click', '.today', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.after_today').prop('checked', false);
			$('.before_today').prop('checked', false);
		}else{
			$('.today').prop('checked', true);
		}
	});
	
	$('body').on('click', '.before_today', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.after_today').prop('checked', false);
			$('.today').prop('checked', false);
		}else{
			$('.before_today').prop('checked', true);
		}
	});
	
	$('body').on('click', '.after_today', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.today').prop('checked', false);
			$('.before_today').prop('checked', false);
		}else{
			$('.after_today').prop('checked', true);
		}
	});
	
	//end date
	$('body').on('click', '.nullable_rule', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.required_rule').prop('checked', false);
		}else{
			$('.required_rule').prop('checked', true);
		}
	});

	$('body').on('click', '.only_number', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.only_char,.char_space,.char_num,.email,.url,.date,.image').attr('disabled',true);
	   
		}else{
			
			$('.only_char,.char_space,.char_num,.email,.url,.date,.image').attr('disabled',false);
		}
	});

	$('body').on('click', '.only_char', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.only_number,.char_space,.char_num,.email,.url,.date,.image').attr('disabled',true);
	   
		}else{
			
			$('.only_number,.char_space,.char_num,.email,.url,.date,.image').attr('disabled',false);
		}
	});

	$('body').on('click', '.char_num', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.only_char,.only_number,.char_space,.email,.url,.date,.image').attr('disabled',true);
		}else{
			$('.only_char,.only_number,.char_space,.char_num,.email,.url,.date,.image').attr('disabled',false);
		}
	});

	$('body').on('click', '.char_space', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.only_char,.only_number,.char_num,.email,.url,.date,.image').attr('disabled',true);
		}else{
			$('.only_char,.only_number,.char_num,.char_num,.email,.url,.date,.image').attr('disabled',false);
		}
	});

	$('body').on('click', '.email', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.only_char,.only_number,.char_num,.char_space,.url,.date,.image').attr('disabled',true);
		}else{
			$('.only_char,.only_number,.char_num,.char_num,.char_space,.url,.date,.image').attr('disabled',false);
		}
	});

	$('body').on('click', '.url', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.only_char,.only_number,.char_num,.char_space,.email,.date,.image').attr('disabled',true);
		}else{
			$('.only_char,.only_number,.char_num,.char_num,.char_space,.email,.date,.image').attr('disabled',false);
		}
	});

	$('body').on('click', '.date', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.only_char,.only_number,.char_num,.char_space,.email,.url,.min,.max,.image').attr('disabled',true);
			
			$.each( $('.date'), function( key, value ) {
				$('#date'+key).attr('disabled',true);
			});
			$(this).attr('disabled',false);
		}else{
			$('.only_char,.only_number,.char_num,.char_num,.char_space,.email,.url,.min,.max,.image').attr('disabled',false);
			
			$.each( $('.date'), function( key, value ) {
				$('#date'+key).attr('disabled',false);
			});
		}
	});
	
	// Add More Dropdown Label Code
	$('.d_label').on('keyup', function() {
		var text = $(this).val();
		if(text!=''){
			$('.drop_label-error').remove();
			$(".d_label").css('border-color','#2b542c');
		}
	});
	
	$('.r_label').on('keyup', function() {
		var text = $(this).val();
		if(text!=''){
			$('.radio_label-error').remove();
			$(".r_label").css('border-color','#2b542c');
		}
	});
	
	$('.c_label').on('keyup', function() {
		var text = $(this).val();
		if(text!=''){
			$('.check_label-error').remove();
			$(".c_label").css('border-color','#2b542c');
		}
	});

	$(document).ready(function(){
		$('body').on('click','.add_more',function(){
			var text = $('.d_label').val();
			$('.drop_label-error').remove();
			if(text!=''){
				$('.drop_label').append('<div class="col-md-12 label_data" id="demo" ><div class=""><input type="hidden" value="'+text+'" name="d_label[]"><label>'+text+'</label><i class="fa fa-trash delete_d_label" aria-hidden="true"></i></div></div>');
				$('.d_label').val('');
				$(".d_label").css('border-color','#2b542c');
			}else{
				$(".d_label").css('border-color','#a94442');
				$('<span class="invalid-feedback drop_label-error"> This field is required.</span>" ').insertAfter(".d_label");
			}
		});
		$('body').on('click','.delete_d_label',function(){
			$(this).parents('.label_data').remove();
		});
	});

	// Add More Checkbox Label Code
	$(document).ready(function(){
		$('body').on('click','.add_more_checkbox',function(){
			var text = $('.c_label').val();
			$('.check_label-error').remove();
			if(text!=''){
				$('.checkbox_label').append('<div class="col-md-12 label_checkbox" id="demo" ><div class=""><input type="hidden" value="'+text+'"  name="c_label[]"><label>'+text+'</label><i class="fa fa-trash delete_c_label" aria-hidden="true"></i></div></div>');
				$(".c_label").css('border-color','#2b542c');
				$('.c_label').val('');
			}else{
				$(".c_label").css('border-color','#a94442');
				$('<span class="invalid-feedback check_label-error"> This field is required.</span>" ').insertAfter(".c_label");
			}
		});
		$('body').on('click','.delete_c_label',function(){
			$(this).parents('.label_checkbox').remove();
		});
	});

	// Add More Radio Label Code
	$(document).ready(function(){
		$('body').on('click','.add_more_radio',function(){
			var text = $('.r_label').val();
			$('.radio_label-error').remove();
			if(text != ''){
				$('.radio_label').append('<div class="col-md-12 label_radio" id="demo" ><div class=""><input type="hidden" value="'+text+'"  name="r_label[]"><label>'+text+'</label><i class="fa fa-trash delete_r_label" aria-hidden="true"></i></div></div>');
				$('.r_label').val('');
				$(".r_label").css('border-color','#2b542c');
			}else{
				$(".r_label").css('border-color','#a94442');
				$('<span class="invalid-feedback radio_label-error"> This field is required.</span>" ').insertAfter(".r_label");
			}
		});
		$('body').on('click','.delete_r_label',function(){
			$(this).parents('.label_radio').remove();
		});
	});

	$('body').on('click','.delete_d_label,.delete_c_label,.delete_r_label',function(){
		$(this).parents('.label_data').remove();
		$(this).parents('.label_checkbox').remove();
		$(this).parents('.label_radio').remove();
		var label_id = $(this).attr('label_id');
	    var url = '{{url('admin/custom_field/delete_label_data')}}';
	
		$.ajax({
			type:'GET',
			url:url,
			data:{label_id:label_id},
			success:function(data){

			},
			error: function(e) 
			{
				alert("An error occurred: " + e.responseText);
				console.log(e);
			},
		});
	});
});	

// Max and Min Validation Code
$(document).ready(function(){
	$('input.opentext[type="checkbox"]').click(function(){
		if($(this).prop("checked") == true){
			var value_data = $(this).attr('max_attr');
			if(value_data == 'max')
			{
				var limit_value = '<?php echo $max_find;?>';
				$('#max_value').attr('value',limit_value);
				$('#max_limit').fadeIn(1000);
			}
			else if(value_data == 'min')
			{
				var limit_value = '<?php echo $min_find;?>';
				$('#min_value').attr('value',limit_value);
				$('#min_limit').fadeIn(1000);
			}
			else if(value_data == 'mimes')
			{
				var limit_value = '<?php echo $mimes_find;?>';
				$('#file_extension_filed').attr('value',limit_value);
				$('#file_extension').fadeIn(1000);
			}
		}
		else
		{
			var value_data = $(this).attr('max_attr');
			if(value_data == 'max')
			{
				$('#max_value').attr('value','');
				$('#max_limit').fadeOut(1000);
			}
			else if(value_data == 'min')
			{
				$('#min_limit').fadeOut(1000);
				$('#min_value').attr('value','');
			}
			else if(value_data == 'mimes')
			{
				$('#file_extension').fadeOut(1000);				
				$('#file_extension_filed').attr('value','');
			}
		}
	});
	
	$('body').on('keyup','#max',function(){
		var limit = 'max:'+$(this).val();
		$('#max_value').attr('value',limit);
	});

	$('body').on('keyup','#min',function(){
		var limit = 'min:'+$(this).val();
		$('#min_value').attr('value',limit);
	});

	$('body').on('keyup','.mimes',function(){
		var limit = 'mimes:'+$(this).val();
		$('#image').attr('value',limit);
	});
	
	$('body').on('click','#image',function(){
		var str = $(this).val();
		var result = str.slice(6);
		$('#file_extension_filed').attr('value',result);		
	});
	
	var dropdwon_data = $(".dropdown_change option:selected").val();

	if(dropdwon_data == 'file')
	{		
		$('.only_char,.only_number,.char_num,.char_space,.email,.date,.url').attr('disabled',true);
		$('.change_max').html('Maximum Size of File(KB)');
		$('.change_min').html('Minimum Size of File(KB)');
	}
	else
	{
		$('.change_max').html('Maximum Limit');
		$('.change_min').html('Minimum Limit');
	}
});
</script>		
</script>	
@endsection
