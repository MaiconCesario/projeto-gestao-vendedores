<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Repositories\VendedorRepository;
use App\Http\Requests\VendedorStoreRequest;
use App\Http\Requests\VendedorUpdateRequest;
use Illuminate\Support\Facades\Hash;

class VendedorController extends Controller
{
    protected $vendedorRepository;

    public function __construct(VendedorRepository $vendedorRepository)
    {
        $this->vendedorRepository = $vendedorRepository;
    }
    
    public function index()
    {
        $vendedor = Vendedor::with('venda')->get();
        return response()->json($vendedor, 200);
    }

    public function store(VendedorStoreRequest $request)
    {

        $vendedor = new Vendedor();
        $vendedor->nome_vendedor = $request->nome_vendedor;
        $vendedor->email = $request->email;
        $vendedor->senha = Hash::make($request->senha);
        $vendedor->save();

        return response()->json($vendedor, 201);
    }

    public function show($id)
    {
        $vendedor = Vendedor::find($id);

        if(!$vendedor)
        {
            return response()->json(['erro' => 'O vendedor pesuqisado não existe'], 404);
        }

        return response()->json($vendedor, 200);
    }


    public function update(VendedorUpdateRequest $request, $id)
    {             
        return $this->vendedorRepository->validateAndUpdate($request, $id);
    }


    public function destroy($id)
    {
        $vendedor = Vendedor::find($id);

        if(!$vendedor)
        {
            return response()->json(['erro' => 'Impossível realizar a exlcusão. O vendedor não existe!'], 404);
        }

        $this->vendedorRepository->delete($vendedor);

        return response()->json(['msg' => 'Vendedor excluído com sucesso']);

    }
}