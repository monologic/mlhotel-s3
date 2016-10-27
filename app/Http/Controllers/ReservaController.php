<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Reserva;
use App\Registro;
use App\Habitacion;
use App\Habtipo;
use App\Hotel;
use App\Habtiporeserva;


class ReservaController extends Controller
{
    public $fechainicio;

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
        //
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
        $reserva = Reserva::find($id);
        $reserva->fill($request->all());
        $reserva->save();
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

    public function getallreservas()
    {
        $reservas = Reserva::all();

        $reservas->each(function($reservas){
            $reservas->cliente;
            $reservas->habtiporeservas;
            $reservas->pagotipo;
            $reservas->reservaestado;
            $habReserva = $reservas->habtiporeservas;
            $reservas->habtiporeservas->each(function($habReserva){
                $habReserva->habtipo;
            });
        });

        $reservas = $reservas->toArray();

        foreach ($reservas as $j => $reserva) {
            $habtipos = $reserva['habtiporeservas'];
            $ht = array();
            foreach ($habtipos as $key => $habtipo) {    
                if (count($ht) > 0) {
                    if($this->countReservas($ht, $habtipo) == 0){
                        $habtipo['habtipo']['count'] = 0;
                        $ht[] = $habtipo['habtipo'];
                    }
                }
                else {
                    $habtipo['habtipo']['count'] = 0;
                    $ht[] = $habtipo['habtipo'];
                }
            }
            foreach ($habtipos as $key => $habtipo) {
                foreach ($ht as $k => $htt) { 
                    if ( $habtipo['habtipo']['id'] == $htt['id'] ){
                        $c = $ht[$k]['count'];
                        $c++;
                        $ht[$k]['count'] = $c;
                    }
                }
            }
            $reservas[$j]['habtiposcount'] = $ht;
            unset($reservas[$j]['habtiporeservas']);
        }
        return response()->json( $reservas );

    }

    public function getReservasNoAsignadas()
    {
        $reservas = Reserva::where('reservaestado_id',2)
                            ->orderBy('fecha_inicio','asc')
                           ->get();

        $reservas->each(function($reservas){
            $reservas->cliente;
        });

        $reservas->each(function($reservas){
            $reservas->pagotipo;
        });

        $reservas->each(function($reservas){
            $reservas->habtiporeservas;
            $habReserva = $reservas->habtiporeservas;
            $reservas->habtiporeservas->each(function($habReserva){
                $habReserva->habtipo;
            });
        });

        $reservas = $reservas->toArray();

        foreach ($reservas as $j => $reserva) {
            $habtipos = $reserva['habtiporeservas'];
            $ht = array();
            foreach ($habtipos as $key => $habtipo) {    
                if (count($ht) > 0) {
                    if($this->countReservas($ht, $habtipo) == 0){
                        $habtipo['habtipo']['count'] = 0;
                        $ht[] = $habtipo['habtipo'];
                    }
                }
                else {
                    $habtipo['habtipo']['count'] = 0;
                    $ht[] = $habtipo['habtipo'];
                }
            }
            foreach ($habtipos as $key => $habtipo) {
                foreach ($ht as $k => $htt) { 
                    if ( $habtipo['habtipo']['id'] == $htt['id'] ){
                        $c = $ht[$k]['count'];
                        $c++;
                        $ht[$k]['count'] = $c;
                    }
                }
            }
            $reservas[$j]['habtiposcount'] = $ht;
        }
        return response()->json( $reservas );
    }

    public function countReservas($ht, $habtipo)
    {
        $c = 0;
        foreach ($ht as $k => $htt) {
            if ( $habtipo['habtipo']['id'] == $htt['id']) {
                $c = 1;
            }
        }
        return $c;
    }

    public function getReserva($id)
    {
        $reservas = Reserva::where('id', $id)
                            ->orderBy('fecha_inicio','asc')
                           ->get();

        $reservas->each(function($reservas){
            $reservas->cliente;
        });

        $reservas->each(function($reservas){
            $reservas->pagotipo;
        });

        $reservas->each(function($reservas){
            $reservas->habtiporeservas;
            $habReserva = $reservas->habtiporeservas;
            $reservas->habtiporeservas->each(function($habReserva){
                $habReserva->habtipo;
            });
        });
        
        $reservas = $reservas->toArray();

        foreach ($reservas as $j => $reserva) {
            $habtipos = $reserva['habtiporeservas'];
            $ht = array();
            foreach ($habtipos as $key => $habtipo) {    
                if (count($ht) > 0) {
                    foreach ($ht as $k => $htt) {
                        if ( $habtipo['habtipo']['id'] == $htt['id']) {
                            $ht[$k]['count']++;
                        }
                        else {
                            $habtipo['habtipo']['count'] = 1;
                            $ht[] = $habtipo['habtipo'];
                        }

                    }
                }
                else {
                    $habtipo['habtipo']['count'] = 1;
                    $ht[] = $habtipo['habtipo'];
                    
                }

                $reservas[$j]['habtiposcount'] = $ht;

            }
        }
        return response()->json( $reservas );
    }
    public function getReservasPorConfirmar()
    {
        $reservas = Reserva::where('reservaestado_id',3)
                            ->orderBy('fecha_inicio','asc')
                           ->get();

        $reservas->each(function($reservas){
            $reservas->cliente;
        });

        $reservas->each(function($reservas){
            $reservas->pagotipo;
        });
        
        $reservas->each(function($reservas){
            $reservas->habtiporeservas;
            $habReserva = $reservas->habtiporeservas;
            $reservas->habtiporeservas->each(function($habReserva){
                $habReserva->habtipo;
            });
        });

        $reservas = $reservas->toArray();

        foreach ($reservas as $j => $reserva) {
            $habtipos = $reserva['habtiporeservas'];
            $ht = array();
            foreach ($habtipos as $key => $habtipo) {    
                if (count($ht) > 0) {
                    if($this->countReservas($ht, $habtipo) == 0){
                        $habtipo['habtipo']['count'] = 0;
                        $ht[] = $habtipo['habtipo'];
                    }
                }
                else {
                    $habtipo['habtipo']['count'] = 0;
                    $ht[] = $habtipo['habtipo'];
                }
            }
            foreach ($habtipos as $key => $habtipo) {
                foreach ($ht as $k => $htt) { 
                    if ( $habtipo['habtipo']['id'] == $htt['id'] ){
                        $c = $ht[$k]['count'];
                        $c++;
                        $ht[$k]['count'] = $c;
                    }
                }
            }
            $reservas[$j]['habtiposcount'] = $ht;


        }
        

        return response()->json( $reservas );
    }
    public function confirmarReserva($id)
    {
        $reserva = Reserva::find($id);
        $reserva->reservaestado_id = 2; // id 2 reserva por asignar;
        $reserva->save();

        return $this->getReservasPorConfirmar();
    }
    public function cancelarReserva($id)
    {
        $reserva = Reserva::find($id);
        $reserva->reservaestado_id = 4; // id 4 cancelar reserva;
        $reserva->save();

        //return $this->getReservasPorConfirmar();
    }
    public function editarFechas(Request $request)
    {
        //$b = $this->busqueda($request->fechaini, $request->fechafin);
        $h = Hotel::all();
        $cregistro = new RegistroController();
        $b = $cregistro->separadorDeFechas2($request->fechaini, $request->fechafin, $h[0]->checkin);

        $reserva = Reserva::find($request->idReserva);
        $reservaObj = $reserva;
        $reserva->habtiporeservas;
        $habReserva = $reserva->habtiporeservas;
        $reserva->habtiporeservas->each(function($habReserva){
            $habReserva->habtipo;
        });
            
        //dd($reserva);

        $reserva = $reserva->toArray();

        
        $habtipos = $reserva['habtiporeservas'];
        $ht = array();
        foreach ($habtipos as $key => $habtipo) {    
            if (count($ht) > 0) {
                foreach ($ht as $k => $htt) {
                    if ( $habtipo['habtipo']['id'] == $htt['id']) {
                        $ht[$k]['count']++;
                    }
                    else {
                        $habtipo['habtipo']['count'] = 1;
                        $ht[] = $habtipo['habtipo'];
                    }

                }
            }
            else {
                $habtipo['habtipo']['count'] = 1;
                $ht[] = $habtipo['habtipo'];
                
            }

            $reserva['habtiposcount'] = $ht;

        }
        // dd($reserva['habtiposcount']);

        $c = count($reserva['habtiposcount']);
        $c2 = 0;
        foreach ($reserva['habtiposcount'] as $i => $habtipoR) {
            foreach ($b as $j => $habtipo) {
                if ($habtipoR['id'] == $habtipo['id']) {
                    if ($habtipoR['count'] <= $habtipo['disponibles']) {
                        $c2++;
                    }
                }
            }
        }
        if ($c2 == $c) {
            $h = Hotel::all();
            $reservaObj->fecha_inicio = $request->fechaini. " " . $h[0]->checkin;
            $reservaObj->fecha_fin = $request->fechafin . " " . $h[0]->checkout;
            $reservaObj->save();

            return response()->json([
                "mensaje" => 1
            ]);

        }
        else{
            return response()->json([
                "mensaje" => 0
            ]);
        }

    }
    public function busqueda($fechaini, $fechafin)
    {
        $h = Hotel::all();
        $this->fechainicio = $fechaini. " " . $h[0]->checkin;
        $fechafin = $fechafin . " " . $h[0]->checkout;
        $r = Registro::select('habitacion_id')
                    ->whereBetween('fechaentrada', [$this->fechainicio, $fechafin])
                    ->orWhere(function($query){
                        $query->whereRaw(\DB::raw("'$this->fechainicio' between `fechaentrada` and `fechasalida`"));
                        })
                    ->get();

        
        $r = $r->toArray();

        if (count($r) != 0) {
            $hab_id_array = array();

            foreach ($r as $key => $regs) {
                foreach ($regs as $k => $habitacion_id)
                    array_push($hab_id_array, $habitacion_id);
            }

            $habs = Habitacion::whereNotIn('id', $hab_id_array)
                              ->orderBy('habtipo_id', 'asc')
                              ->get();
        }
        else {
            $habs = Habitacion::orderBy('habtipo_id', 'asc')
                              ->get();
        }
        
        
        $habs->each(function($habs){
            $habs->estado;
        });
        $habs->each(function($habs){
            $habs->habtipo;
        });

        $habs = $habs->toArray();

        $habtipos = Habtipo::where('activo', 1)->get();

        /*
        $habtipos->each(function($habtipos){
            $iconos=$habtipos->habtipo_serviciointernos;
            $habtipos->habtipo_serviciointernos->each(function($iconos){
                $iconos->serviciointerno;
            });

        });
        */
        $habtipos = $habtipos->toArray();

        foreach ($habs as $key => $hab) {
            foreach ($habtipos as $k => $habtipo) {
                if ($habtipo['id'] == $hab['habtipo_id']) {
                    $habtipos[$k]['habitaciones'][] = $hab;
                }
            }
        }
        //dd($habtipos);
        $reservas = Reserva::whereBetween('reservaestado_id', array(2,3))
                          ->whereBetween('fecha_inicio', [$this->fechainicio, $fechafin])
                          ->orWhere(function($query){
                            $query->whereRaw(\DB::raw("'$this->fechainicio' between `fecha_inicio` and `fecha_fin`"));
                            })
                          ->get();


        

        $reservas->each(function($reservas){
            $reservas->habtiporeservas;
        });     
        
        $reservas = $reservas->toArray();
        if (count($reservas) != 0) {
            foreach ($reservas as $h => $reserva) {
                foreach ($reserva['habtiporeservas'] as $i => $habtipo) {
                    foreach ($habtipos as $k => $ht) {
                        if ( $ht['id'] == $habtipo['habtipo_id']) {
                            $habtipos[$k]['habtiporeservas'][] = $habtipo;
                        }
                        if (!isset($habtipos[$k]['habtiporeservas'])) {
                            $habtipos[$k]['habtiporeservas'] = null;
                        }
                        
                    }
                }
            }
        }
        //dd($habtipos);
        foreach ($habtipos as $k => $habtipo) {
            if (count($reservas) != 0) {
                $r = count($habtipo['habtiporeservas']);
                $habtipos[$k]['habtiporeservascount'] = $r;
            }
            else
                $habtipos[$k]['habtiporeservascount'] = 0   ;
            
            $r2 = count($habtipo['habitaciones']);
            $habtipos[$k]['habitacionescount'] = $r2;
            $habtipos[$k]['disponibles'] = $habtipos[$k]['habitacionescount']-$habtipos[$k]['habtiporeservascount'];
            

        }
        //dd($habtipos);
        return $habtipos;
    }
}
                        