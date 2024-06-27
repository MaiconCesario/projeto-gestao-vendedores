<?php

namespace App\Http\Controllers;

use App\Models\Vendedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendedorController extends Controller
{
    public function __construct(Vendedor $vendedor)
    {
        $this->vendedor = $vendedor;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendedor= $this->vendedor->with('venda')->get();
        return response()->json($vendedor, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = $request->validate($this->vendedor->rules(), $this->vendedor->feedback());

        $vendedor = $this->vendedor->fill([
            'nome_vendedor' => $request->nome_vendedor,
            'email' => $request->email,
            'senha' => bcrypt($request->senha)
        ])->save();
        
        return response()->json([$vendedor, $regras], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendedor = $this->vendedor->with('venda')->find($id);
        if($vendedor === null){
            return response(['erro' => 'O vendedor pesquisado não existe']);
        }

        return response()->json($vendedor, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{             
    $vendedor = $this->vendedor->find($id);

    if ($vendedor === null) {
        return response(['erro' => 'Impossível realizar a alteração. O vendedor não existe!']);
    } 

    // Validação dos dados
    $rules = $vendedor->rules();
    $feedback = $vendedor->feedback();

    $regrasDinamicas = $rules; // Inicializa com todas as regras

    if ($request->isMethod('PATCH')) {
        $regrasDinamicas = [];
        foreach ($rules as $key => $regras) {
            if ($request->has($key)) {
                $regrasDinamicas[$key] = $regras;
            }
        }
    }

    $validator = Validator::make($request->all(), $regrasDinamicas, $feedback);

    if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()], 400);
    }

    // Atualização dos dados
    $data = $request->only(array_keys($regrasDinamicas));

    // Verifica se uma nova senha foi fornecida e a criptografa
    if (isset($data['senha'])) {
        $data['senha'] = bcrypt($data['senha']);
    }

    $vendedor->fill($data); // Atualiza os atributos do modelo
    $vendedor->save(); // Salva as mudanças no banco de dados

    return response()->json($vendedor, 200);
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vendedor = $this->vendedor->find($id);

        if($vendedor === null)
        {
            return response(['erro' => 'Impossível realizar a exclusão. O vendedor não existe.']);
        } else {
            $vendedor->delete();
        }

        return response()->json(['msg' => 'Vendedor excluído com sucesso!']);
    }
}
