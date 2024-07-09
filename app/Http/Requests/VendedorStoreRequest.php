<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendedorStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules ()
    {
        return [
            'nome_vendedor' => 'required|min:3|max:50',
            'email' => 'required|unique:vendedores,email,'.$this->id,
            'senha' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :Attribute é obrigatório',
            'nome_vendedor.min' => 'O nome deve conter no mínimo 3 caracteres!',
            'nome_vendedor.max' => 'O nome deve conter no máximo 50 caracteres!',
            'email.unique' => 'O email inserido já está cadastrado'
        ];
    }
}
