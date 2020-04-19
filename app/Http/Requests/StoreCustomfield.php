<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomfield extends FormRequest
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
            'module_name' => 'required',
			'label' => 'required|max:50|alpha_spl',
			'type' => 'required'
        ];
    }
	
	public function messages()
	{
		return [
			'module_name.required'=>'Module Name is required',
			'label.required'=>'Label is required',
			'type.required'=>'Type is required',
			'label.max' =>'The label value may not be greater than 50 characters.',
			'label.alpha_spl' =>"The label may only contain alphabets, space and _ ,`'.^-&",
		];
	}
}
