@extends('layouts.app')
@section('css')
<style>
.help-block span{
	color:#FF0000;
}
</style>
@endsection

@section('content')
	<form method="post" id="my-form" action="{{ url('custom_field/store')}}" enctype="multipart/form-data">
		@csrf
		@method('POST')
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">Add Custom Field</div>
				<div class="panel-body">
					<div class="form-group">
						<label>Module Name</label>
						<select class="form-control" name="module_name">
							<option value="">Select Module</option>
							<option value="attendee">Attendee</option>
						</select>
						@if ($errors->has('module_name'))
							<span class="help-block">
								 <span>{{ $errors->first('module_name') }}</span>
							</span>
						@endif
					</div>
										
					<div class="form-group">
						<label>Label</label>
						<input class="form-control" type="text" name="label" value="{{ old('label') }}">
						@if ($errors->has('label'))
							<span class="help-block">
								 <span>{{ $errors->first('label') }}</span>
							</span>
						@endif
					</div>
										
					<div class="form-group">
						<label>Type</label>
						 <select class="form-control dropdown_change" name="type">
							<option value="">Select Input Type</option>
							<option value="text">Text Box</option>
							<option value="textarea">Textarea</option>
							<!--<option value="dropdown">Dropdown</option>-->
							<option value="date">Date Field</option>
							<!--<option value="checkbox">Checkbox</option>
							<option value="radio">Radio</option>-->
							<!--<option value="file">File</option>-->
						 </select>
						@if ($errors->has('type'))
							<span class="help-block">
								 <span>{{ $errors->first('type') }}</span>
							</span>
						@endif
					</div>
										
					<div class="form-group sub_cat col-md-12" style="display:none;"> 
						<div class="row">
							<label>Dropdown Label</label>
							
							<div class="col-md-12" id="drop_label" >
								  <div class="row drop_label">
								  </div>
							</div>
							<div class="col-md-10">
								<div class="row">
									<input class="form-control d_label" type="text" value=""> 
								</div>
							</div>
							
							<div class="col-md-2">
								
								<input type="button"  name="menu_web" class="btn btn-round btn-default add_more" value="Add More">
								
							</div>
						</div>
					</div>
					
					<div class="form-group checkbox_cat col-md-12" style="display:none;"> 
						<div class="row">
							<label>Checkbox Label</label>
							
							<div class="col-md-12" id="checkbox_label" >
								  <div class="row checkbox_label">
								  </div>
							</div>
							<div class="col-md-10">
								<div class="row">
									<input class="form-control c_label" type="text" value=""> 
								</div>
							</div>
							
							<div class="col-md-2">
								
								<input type="button"  name="menu_web" class="btn btn-round btn-default add_more_checkbox" value="Add More">
								
							</div>
						</div>
					</div>
					
					<div class="form-group radio_cat col-md-12" style="display:none;"> 
						<div class="row">
							<label>Radio Field Label</label>
							
							<div class="col-md-12" id="radio_label" >
								  <div class="row radio_label">
								  </div>
							</div>
							<div class="col-md-10">
								<div class="row">
									<input class="form-control r_label" type="text" value=""> 
								</div>
							</div>
							
							<div class="col-md-2">
								
								<input type="button"  name="menu_web" class="btn btn-round btn-default add_more_radio" value="Add More">
								
							</div>
						</div>
					</div>
					
					 <div class="form-group">
						<label>Validation</label>
						<div class="checkbox">
							<label class="checkbox-inline">
								   <input type="checkbox" name="validation[]"  value="nullable" class="nullable_rule" checked>Nullable
							</label>
							<label class="checkbox-inline">
								   <input type="checkbox" name="validation[]"  value="required" class="required_rule">Required
							</label>
							<label class="checkbox-inline">
								   <input type="checkbox"  name="validation[]"  value="numeric" class="only_number">Only Number
							</label>
							<label class="checkbox-inline">
								   <input type="checkbox" name="validation[]"  value="alpha"  class="only_char">Only Character
							</label>
							<label class="checkbox-inline">
								   <input type="checkbox" name="validation[]"  value="alpha_space"  class="char_space">Character with Space
							</label>
							<label class="checkbox-inline">
								   <input type="checkbox" class="char_num" name="validation[]"  value="alpha_num">Number & Character
							</label>
							<label class="checkbox-inline">
								   <input type="checkbox"  class="email" name="validation[]"  value="email">Email
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="validation[]" class="opentext max" id="max_value" value="max">Maximum
							</label>
							
							<label class="checkbox-inline">
								<input type="checkbox" name="validation[]" class="opentext min" id="min_value" value="min">Minimum
							</label>
							<label class="checkbox-inline">
								   <input type="checkbox" class="url" name="validation[]"  value="url">URL
							</label>
						
							<label class="checkbox-inline">
								  <input type="checkbox" name="validation[]" id="date0" class="date" value="before_or_equal:today"  >Before Or Equal(Today's Date)
							</label>
							<label class="checkbox-inline">
								<input type="checkbox" name="validation[]" id="date1"  class="date"   value="date_equals:today" >Today's Date
							</label>
							<label>
							<input type="checkbox" name="validation[]" id="date2"  class="date"   value="after_or_equal:today" >After Or Equal(Today's Date)
							</label>
							<label>
								<input type="checkbox" name="validation[]" id="image" class="opentext image" value="mimes">File Extension
							</label>
						</div>
						
					</div>
					
					<div class="form-group" id="max_limit" style="display:none;">
						<label class="change_max">Maximum Limit:</label>
						<input type="text" class="form-control"   id="max" value="">
					</div>
					
					<div class="form-group" id="min_limit" style="display:none;">
						<label class="change_min">Minimum Limit:</label>
						<input type="text" class="form-control" id="min" value="">
					</div>
					<div class="form-group" id="file_extension" style="display:none;">
						<label>File Extension</label>
						<input type="text" class="form-control mimes" id="file_extension_filed" value="" style="text-transform:uppercase">
						<label>Note: use comma seprated value(',') in between two diffrent formates  Like:(JPEG,PNG,DOXS)</label>
					</div>
			</div>
		</div>
	</div>
<button type="submit" class="btn btn-success">Submit</button>
 <br><br>
</div>
</form>
</div>
<script>
$(document).ready(function(){
	<!-- Make checked required or nullable code start -->
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
	
	$('body').on('click', '.required_rule', function() 
	{
		if($(this).prop("checked") == true)
		{
			$('.nullable_rule').prop('checked', false);
		}else{
			$('.nullable_rule').prop('checked', true);
		}
	});

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
			
			$('.only_char,.only_number,.char_num,.char_space,.email,.url,.min,.max,.image').attr('disabled',false);
			
			$.each( $('.date'), function( key, value ) {
				$('#date'+key).attr('disabled',false);
			});
		}

	});
	<!-- Make checked required or nullable code end -->
	$('body').on('change', '.dropdown_change', function(){
		
		var dropdwon_data = $(".dropdown_change option:selected").val();
		if (dropdwon_data == 'text' || dropdwon_data == 'textarea' )
		{
			$('.date,.image').attr('disabled',true);
			$('.only_number,.only_char,.char_space,.char_num,.email,.max,.min,.url').attr('disabled',false);
			$('.radio_cat').fadeOut(1000);
			$('.checkbox_cat').fadeOut(1000);
			$('.sub_cat').fadeOut(1000);
			$('.image_cat').fadeOut(1000);
			$('.change_max').html('Maximum Limit');
			$('.change_min').html('Minimum Limit');
		
		}else if (dropdwon_data == 'dropdown')
		{
			$('.radio_cat').fadeOut(1000);
			$('.checkbox_cat').fadeOut(1000);
			$('.sub_cat').fadeIn(1000);
			$('.image_cat').fadeOut(1000);
			$('.only_number,.only_char,.char_space,.char_num,.email,.max,.min,.url,.date,.image').attr('disabled',true);
			$('.change_max').html('Maximum Limit');
			$('.change_min').html('Minimum Limit');
			
			//add validation rules
			$('.d_label').each(function () {
				$(this).rules("add", {
					alpha_space:true,
					lessFifty:true,					
				});
			});
		}
		else if(dropdwon_data == 'checkbox')
		{
			$('.only_number,.only_char,.char_space,.char_num,.email,.max,.min,.url,.date,.max_size,.min_size,.image').attr('disabled',true);
			$('.sub_cat').fadeOut(1000);
			$('.radio_cat').fadeOut(1000);
			$('.checkbox_cat').fadeIn(1000);
			$('.image_cat').fadeOut(1000);
			$('.change_max').html('Maximum Limit');
			$('.change_min').html('Minimum Limit');
			
			//add validation rules
			$('.c_label').each(function () {
				$(this).rules("add", {
					alpha_space:true,
					lessFifty:true,					
				});
			});
		}
		else if(dropdwon_data == 'radio')
		{
			$('.only_number,.only_char,.char_space,.char_num,.email,.max,.min,.url,.date,.image').attr('disabled',true);
			$('.sub_cat').fadeOut(1000);
			$('.checkbox_cat').fadeOut(1000);
			$('.radio_cat').fadeIn(1000);
			$('.image_cat').fadeOut(1000);
			$('.change_max').html('Maximum Limit');
			$('.change_min').html('Minimum Limit');
			
			//add validation rules
			$('.r_label').each(function () {
				$(this).rules("add", {
					alpha_space:true,
					lessFifty:true,					
				});
			});
		}else if(dropdwon_data == 'date'){
			
			$('.only_number,.only_char,.char_space,.char_num,.email,.max,.min,.url,.image').attr('disabled',true);
			$('.date').attr('disabled',false);
			$('.change_max').html('Maximum Limit');
			$('.change_min').html('Minimum Limit');
		}
		else if(dropdwon_data == 'file')
		{
			$('.only_number,.only_char,.char_space,.char_num,.email,.url,.date').attr('disabled',true);
			$('.image,.max,.min').attr('disabled',false);
			$('.sub_cat').fadeOut(1000);
			$('.checkbox_cat').fadeOut(1000);
			$('.radio_cat').fadeOut(1000);
			$('.image_cat').fadeIn(1000);
			$('.change_max').html('Maximum Size of File(KB)');
			$('.change_min').html('Minimum Size of File(KB)');			
		}
		else
		{
			$('.only_number,.only_char,.char_space,.char_num,.email,.url,.date,.image').attr('disabled',false);
			$('.radio_cat').fadeOut(1000);
			$('.checkbox_cat').fadeOut(1000);
			$('.sub_cat').fadeOut(1000);
			$('.image_cat').fadeOut(1000);
			$('.change_max').html('Maximum Limit');
			$('.change_min').html('Minimum Limit');
		}
	});
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
		if(text!=''){
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

// Max and Min Validation Code
$(document).ready(function(){
	$('input.opentext[type="checkbox"]').click(function(){
		if($(this).prop("checked") == true){
			var value_data = $(this).attr('value');
			if(value_data == 'max')
			{
				$('#max_limit').fadeIn(1000);
				//add validation rules
				$('#max').rules("add", {
					number:true,
					lessFive:true,
					min:1,
				});
			}
			else if(value_data == 'min')
			{
				$('#min_limit').fadeIn(1000);
				$('#min').rules("add", {
					number:true,
					lessFive:true,
					min:1,
				});
			}
			else if(value_data == 'mimes')
			{
				$('#file_extension').fadeIn(1000);
				$('#file_extension_filed').rules("add", {
					string:true,
					lessFive:true,
					min:1,
				});
			}
		}
		else
		{
			$('#min_limit').fadeOut(1000);
			$('#max_limit').fadeOut(1000);
			$('#file_extension').fadeOut(1000);
			$('#min_limit_kb').fadeOut(1000);
			$('#max_limit_kb').fadeOut(1000);
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
});
</script>			
@endsection
