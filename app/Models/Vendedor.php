<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;
    protected $table = 'vendedores';
    protected $fillable = ['nome_vendedor','email','senha'];

    public function venda ()
    {
        return $this->hasMany('App\Models\Venda');
    }

    public function rules ()
    {
        return [
            'nome_vendedor' => 'required|min:3|max:50',
            'email' => 'required|unique:vendedores,email,'.$this->id,
            'senha' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :Attribute é obrigatório',
            'nome_vendedor.min' => 'O nome deve conter no mínimo 5 caracteres!',
            'nome_vendedor.max' => 'O nome deve conter no máximo 50 caracteres!',
            'email.unique' => 'O email inserido já está cadastrado'
        ];
    }
}
