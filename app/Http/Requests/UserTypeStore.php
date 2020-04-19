<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserTypeStore extends FormRequest
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
            'typename' => 'required|alpha_space|unique:usertypes,type_name,'.(isset($this->type_id->id)?$this->type_id->id:''),
        ];
    }
	
	public function messages()
	{
		$messages = [
			'typename.required' => 'Type name is required',
			'typename.unique' => 'Type name already exist',
			'typename.alpha_space' => 'Type name allow only character with space'
		];
		return $messages;
	}
}
