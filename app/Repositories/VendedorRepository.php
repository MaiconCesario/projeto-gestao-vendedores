<?php

namespace App\Repositories;

use App\Models\Vendedor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\VendedorUpdateRequest;

class VendedorRepository
{
    protected $vendedor;

    public function __construct(Vendedor $vendedor)
    {
        $this->vendedor = $vendedor;
    }

    public function find($id)
    {
        return $this->vendedor->find($id);
    }

    public function update(Vendedor $vendedor, array $data)
    {
        if (isset($data['senha'])) {
            $data['senha'] = Hash::make($data['senha']);
        }
        $vendedor->fill($data);
        $vendedor->save();
    }

    public function delete(Vendedor $vendedor)
    {
        $vendedor->delete();
    }

    public function validateAndUpdate(VendedorUpdateRequest $request, $id)
    {
        $vendedor = Vendedor::find($id);

        if (!$vendedor) {
            return response()->json(['erro' => 'Vendedor não encontrado'], 404);
        }

        $validator = Validator::make($request->all(), $request->rules(), $request->messages());

        if ($validator->fails()) {
            return response()->json(['erro' => $validator->errors()], 400);
        }

        $data = $request->only(['nome_vendedor', 'email', 'senha']);

        $this->update($vendedor, $data);

        return response()->json($vendedor, 200);
    }
}