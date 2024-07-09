<?php

namespace App\Repositories;

use App\Models\Venda;

class VendaRepository
{
    protected $venda;

    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }

    public function all()
    {
        return $this->venda->with('vendedor')->get();
    }

    public function find($id)
    {
        return $this->venda->with('vendedor')->find($id);
    }

    public function create(array $data)
    {
        $data['comissao'] = $data['valor_total'] * 0.085;
        return $this->venda->create($data);
    }

    public function rules()
    {
        return $this->venda->rules();
    }

    public function feedback()
    {
        return $this->venda->feedback();
    }
}