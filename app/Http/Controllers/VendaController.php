<?php

namespace App\Http\Controllers;

use App\Http\Requests\VendaStoreRequest;
use App\Repositories\VendaRepository;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    protected $vendaRepository;

    public function __construct(VendaRepository $vendaRepository)
    {
        $this->vendaRepository = $vendaRepository;
    }

    public function index()
    {
        $vendas = $this->vendaRepository->all();
        return response()->json($vendas, 200);
    }

    public function store(VendaStoreRequest $request)
    {
        $data = $request->validated();
        $this->vendaRepository->create($data);
        return response()->json(['msg' => 'Venda cadastrada com sucesso'], 201);
    }

    public function show($id)
    {
        $venda = $this->vendaRepository->find($id);

        if ($venda === null) {
            return response()->json(['erro' => 'O recurso pesquisado não existe'], 404);
        }

        return response()->json($venda, 200);
    }
}