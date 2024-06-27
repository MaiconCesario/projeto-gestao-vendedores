<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function __construct(Venda $venda)
    {
        $this->venda = $venda;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venda = $this->venda->with('vendedor')->get();

        return response()->json($venda, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->venda->rules(), $this->venda->feedback());

        $venda = $this->venda->fill([
            'vendedor_id' => $request->vendedor_id,
            'valor_total' => $request->valor_total,
            'comissao' => $request->valor_total * 0.085,
            'data_venda' => $request->data_venda
        ])->save();

        return response()->json(['msg' => 'Venda cadastrada com sucesso'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venda = $this->venda->with('vendedor')->find($id);

        if($venda === null)
        {
            return response()->json(['erro' => 'O recurso pesquisado não existe']);
        }

        return response()->json($venda, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function edit(Venda $venda)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venda $venda)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venda  $venda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venda $venda)
    {
        //
    }
}
