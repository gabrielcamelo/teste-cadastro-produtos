<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'image'       => 'required|image|mimes:jpg,jpeg,png|max:100|dimensions:min_width=300,min_height=300',
            'name'        => 'required|max:50',
        ];
    }

    public function messages(){
        return [
            'image.required'       => 'O campo imagem é obrigatório',
            'image.image'          => 'É aceito somente aquivo de imagem',
            'image.mimes'          => 'São aceitos somente os tipos de imagem jpeg, jpg e png',
            'image.max'            => 'O tamanho máximo da imagem é de 100kB',
            'image.dimensions'     => 'Dimensão mínima da imagem é de 300px de largura por 300px de altura',
            'name.required'        => 'O campo nome é obrigatório',
            'name.max'             => 'O campo nome aceita no máximo 50 caracteres',
        ];
    }
}
