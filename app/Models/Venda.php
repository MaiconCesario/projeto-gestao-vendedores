<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;
    protected $fillable = ['vendedor_id','valor_total','comissao','data_venda'];

    public function vendedor ()
    {
        return $this->belongsTo('App\Models\Vendedor');
    }

    public function rules()
    {
        return [
            'vendedor_id' => 'required',
            'valor_total' => 'required',
            'data_venda' => 'required'
        ];
    }

    public function feedback()
    {
        return[
            'required' => 'O campo :attribute é obrigatório'
        ];
    }
}
