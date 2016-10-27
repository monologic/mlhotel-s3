<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Cliente;
use App\Regcliente;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente = new Cliente($request->all());
        $cliente->save();

        $regClientes = $this->storeRegCliente($request->registro_id, $cliente->id, $request->procedencia, $request->destino);

        return response()->json( $regClientes );
    }

    public function storeRegCliente($registro_id, $cliente_id , $procedencia, $destino)
    {
        $regCliente = new Regcliente();
        $regCliente->registro_id = $registro_id;
        $regCliente->cliente_id = $cliente_id;
        $regCliente->procedencia = $procedencia;
        $regCliente->destino = $destino;
        $regCliente->save();

        return $this->getRegClientes($registro_id); 
    }
    public function buscart($tipo, $valor)
    {
        $bcliente = Cliente::where($tipo, $valor)->get();
        return response()->json( $bcliente );
    }
    public function getRegClientes($registro_id)
    {
        $regClientes = Regcliente::where('registro_id', $registro_id)->get();

        $regClientes->each(function($regClientes){
            $regClientes->cliente;
        });

        return $regClientes; 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $cliente->fill($request->all());
        $cliente->save();

        $regClientes = $this->storeRegCliente($request->registro_id, $cliente->id, $request->procedencia, $request->destino);

        return response()->json( $regClientes );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buscarHuesped($dni)
    {
        $cliente = Cliente::where('dni', $dni)->get();

        return response()->json( $cliente );
    }

    public function eliminarRegCliente($id)
    {
        $regCliente = Regcliente::find($id);
        $registro_id = $regCliente->registro_id;
        $regCliente->delete();
        return $this->getRegClientes($registro_id);
    }
    public function getclientes()
    {
        $Cliente = Cliente::orderBy('nombres', 'asc')->get();
        $Cliente = $Cliente ->toArray();


        return response()->json( $Cliente );
    }
}
