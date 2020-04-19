<?php

namespace App\Http\Requests;

use DB;
use Illuminate\Foundation\Http\FormRequest;

class attendeeStore extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'serial_number' => 'required',
            'event_id' => 'required',
            'salutation' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:attendees,email,'.(isset($this->attendee_id->id)?$this->attendee_id->id:''),
            'type_id' => 'required',
            'country' => 'required',
            'company' => 'required'
        ];
		
		$customFields = getCustomFieldByModule('attendee');
		
		$customFields = json_decode($customFields);
        foreach($customFields as $customs)
		{
			if($this->id != NULL){
				if(strpos($customs->field_validation, 'after_or_equal:today')!= false ||  strpos($customs->field_validation, 'before_or_equal:today')!= false    ||  strpos($customs->field_validation, 'date_equals:today')!= false){
					$customs->field_validation = str_replace(['after_or_equal:today','before_or_equal:today','date_equals:today'],['','',''],$customs->field_validation);
					$rules['custom.'.$customs->id] = $customs->field_validation;
				}else{
					$rules['custom.'.$customs->id] = $customs->field_validation;
				}
			}else{
				$rules['custom.'.$customs->id] = $customs->field_validation;
			}
		}
		
		return $rules;
    }
	
	public function messages()
    {
		$messages =  [
			'serial_number.required' => 'Serial Number is required',
			'event_id.required' => 'Event is required',
			'salutation.required' => 'Salutation is required',
			'first_name.required' => 'First Name is required',
			'last_name.required' => 'Last Name is required',
			'email.required' => 'Email is required',
			'email.email' => 'Invalid Email format',
			'email.unique' => 'Email already exist',
			'type_id.required' => 'User Type is required',
			'country.required' => 'Country is required',
			'company.required' => 'Company is required',
		];
		
		$customMessage = array();
		$custom = DB::table('custom_fields')->where([['module','=','attendee'],['field_visibility','=',1],['field_validation','!=','']])->get();
		
		foreach($custom as $customs)
		{
			$exa = explode('|',$customs->field_validation);
			$min = "";
			$max = "";
			foreach($exa as $key=>$value)
			{
				if(strpos($value, 'mimes') !== false)
				{
				   $max = $value;
				   $limit_value_max = substr($max,6);
				   $customMessage['custom.'.$customs->id.'.mimes'] = ucwords($customs->field_label).' in only accept ' .$limit_value_max.' this format';
				}
				elseif(strpos($value, 'min') !== false)
				{
					$valid = $customs;	
					$img = $valid->field_validation;
					if(strpos($img, 'mimes') !== false)
					{
						$min = $value;
						$limit_value_min = substr($min,4) * 1024;
						$min_kb = substr($min,4);
						$customMessage['custom.'.$customs->id.'.min'] = ucwords($customs->field_label).' minimum size ' .$min_kb.' Kb.';
					}
					else
					{
						$min = $value;
						$limit_value_min = substr($min,4);
						$customMessage['custom.'.$customs->id.'.min'] = ucwords($customs->field_label).' length minimum ' .$limit_value_min.' character';
					}
				}
				elseif(strpos($value, 'max') !== false)
				{
					$valid = $customs;	
					$img = $valid->field_validation;
					if(strpos($img, 'mimes') !== false)
					{
						$max = $value;
						$limit_value_max = substr($max,4) * 1024;
						$max_size = substr($max,4);
						$customMessage['custom.'.$customs->id.'.max'] = ucwords($customs->field_label).' maximum size ' .$max_size.' Kb.';
					}
					else
					{
						$max = $value;
						$limit_value_max = substr($max,4);
						$customMessage['custom.'.$customs->id.'.max'] = ucwords($customs->field_label).' length maximum ' .$limit_value_max.' character';
					}
				}
				elseif(strpos($value, 'required') !== false)
				{
					$customMessage['custom.'.$customs->id.'.required'] =  ucwords($customs->field_label)." is required";
				}
				elseif(strpos($value, 'numeric') !== false)
				{
					$customMessage['custom.'.$customs->id.'.numeric'] = ucwords($customs->field_label).' must be digits only';
				}
				elseif(strpos($value, 'email') !== false)
				{
					$customMessage['custom.'.$customs->id.'.email'] = 'Please enter a valid email address';
				}
				elseif($value == 'alpha')
				{
					$customMessage['custom.'.$customs->id.'.alpha'] = 'Please enter only character';
				}
				elseif(strpos($value, 'alpha_num') !== false)
				{
					$customMessage['custom.'.$customs->id.'.alpha_num'] = 'Please enter only character and number';
				}
				elseif(strpos($value, 'url') !== false)
				{
					$customMessage['custom.'.$customs->id.'.url'] = 'Please enter valid URL';
				}
				elseif(strpos($value, 'alpha_space') !== false)
				{
					$customMessage['custom.'.$customs->id.'.alpha_space'] = ucwords($customs->field_label)." allow only character and space";
				}
				elseif(strpos($value, 'after_or_equal') !== false )
				{
					$customMessage['custom.'.$customs->id.'.after_or_equal'] = ucwords($customs->field_label)." date is must be after of equal to today";
					
				}
				elseif(strpos($value, 'date_equals') !== false )
				{
					$customMessage['custom.'.$customs->id.'.date_equals'] = ucwords($customs->field_label)." date is must be today";
				}
				elseif(strpos($value, 'before_or_equal') !== false)
				{
					$customMessage['custom.'.$customs->id.'.before_or_equal'] = ucwords($customs->field_label)." date is  must be before of equal to today";
				}
			}
		}
		
		$messages  = array_merge($messages,$customMessage);
		return $messages;
	}
}
