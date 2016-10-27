<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Habitacion;
use App\Habtipo;


class HabitacionController extends Controller
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
        $habitacion = new Habitacion($request->all());
        $habitacion->hotel_id = Auth::user()->empleado->hotel->id;
        $habitacion->save();

        return response()->json([
            "mensaje" => 'Habitación Creada'
        ]);
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
        $habitacion = Habitacion::find($id);
        $habitacion->fill($request->all());
        $habitacion->save();

        return $this->getHabitacions();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Habitacion::destroy($id);

        return $this->getHabitacions();
    }

    public function getHabitacions()
    {
        $habitaciones =  Habitacion::where([
                            ['hotel_id', Auth::user()->empleado->hotel->id],
                        ])->orderBy('numero', 'asc')->get();

        $habitaciones->each(function($habitaciones){
            $habitaciones->estado;
        });
        $habitaciones->each(function($habitaciones){
            $habitaciones->habtipo;
        });

        return response()->json( $habitaciones->toArray() );
    }
    public function getHabitacionsDetallado()
    {
        $habitaciones =  Habitacion::where([
                            ['hotel_id', Auth::user()->empleado->hotel->id],
                        ])
                        ->orderBy('numero', 'asc')   
                        ->get();

        $habitaciones->each(function($habitaciones){
            $habitaciones->estado;
            $habitaciones->habtipo;
        });
        $habitaciones = $habitaciones->toArray();
        
        $registros = RegistroController::registrosDeHoy();
        //dd($registros);
        foreach ($habitaciones as $key => $habitacion) {
            $habitaciones[$key]['registro'] = array();
            foreach ($registros as $k => $registro) {
                if ($habitacion['id'] == $registro['habitacion_id']) {
                    $habitaciones[$key]['registro'] = $registro;
                }
            }
        }
        
        return response()->json( $habitaciones );   
    }
}
