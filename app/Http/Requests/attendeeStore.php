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
            'event_id' => 'required',
            'salutation' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:attendees,email,'.(isset($this->attendee_id->id)?$this->attendee_id->id:''),
            'type_id' => 'required',
            'country' => 'required',
            'company' => 'required'
        ];
		
		return $rules;
    }
	
	public function messages()
    {
		$messages =  [
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
		
		$messages  = array_merge($messages,$customMessage);
		return $messages;
	}
}
