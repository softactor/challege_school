<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class templateStore extends FormRequest
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
            'template_name' => 'required',
            'event_id' => 'required',
            'type_id' => 'required',
            'page_height' => 'required|digits_between:1,5',
            'page_width' => 'required|digits_between:1,5',
        ];
    }
	
	public function messages()
    {
		$messages =  [
			'template_name.required' => 'Template Name is required',
			'event_id.required' => 'Event is required',
			'type_id.required' => 'User Type is required',
			'page_height.required' => 'Page Height is required',
			'page_height.numeric' => 'Insert only numeric value',
			'page_width.required' => 'Page Width is required',
			'page_width.numeric' => 'Insert only numeric value',
		];
		
		return $messages;
	}
}
