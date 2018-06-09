<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateCourseFormRequest extends FormRequest
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
            'name' => "required|min:3|max:50|unique:courses,name,{$this->id}",
            'description' => 'max:1000',
            'category_id' => 'required',
            'image' => 'image'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'O campo categoria é obrigatório.',
        ];
    }

}
