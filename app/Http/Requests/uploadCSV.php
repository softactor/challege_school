<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class uploadCSV extends FormRequest
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
        return [
            'attendee_csv' => 'required',
        ];
    }
	
	public function messages()
    {
		$messages =  [
			'attendee_csv.required' => 'Upload CSV is required',
		];
		
		return $messages;
	}
}
