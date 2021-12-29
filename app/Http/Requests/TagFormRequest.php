<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:50',
        ];
    }

    public function messages(){
        return [
            'name.required'   => 'O campo nome é obrigatório',
            'name.max'        => 'O campo nome aceita no máximo 50 caracteres',
        ];
    }
}
