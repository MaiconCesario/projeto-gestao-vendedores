<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendedorUpdateRequest extends FormRequest
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

    public function rules ()
    {
        $rules = [
            'nome_vendedor' => 'required|min:3|max:50',
            'email' => 'required|unique:vendedores,email,'.$this->id,
            'senha' => 'required'
        ];

        if ($this->isMethod('patch')) {
            foreach ($rules as $key => &$rule) {
                $rule = 'sometimes|' . $rule;
            }
        }

        return $rules;
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
