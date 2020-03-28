<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MarcaFormRequest extends FormRequest
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
            'marca' => ['bail', 'required', 'string', 'unique'],
            'img' => ['bail', 'image', 'mimes:jpg,jpeg,png'],
            'precio' => ['bail', 'required', 'numeric']
        ];
    }
}
