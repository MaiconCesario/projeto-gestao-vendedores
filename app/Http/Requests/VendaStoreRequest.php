<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendaStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'vendedor_id' => 'required',
            'valor_total' => 'required',
            'data_venda' => 'required'
        ];
    }

    public function messages()
    {
        return[
            'required' => 'O campo :attribute é obrigatório'
        ];
    }
}
