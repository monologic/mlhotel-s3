<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Registro;
use App\Regcliente;
use App\Habitacion;
use App\Habtipo;
use App\Reserva;
use App\Hotel;
use App\Habtiporeserva;

use App\Serviciointerno;
use App\Habtipo_serviciointerno;

use DB;

class RegistroController extends Controller {

    public $fechainicio;
    static $fechaInicio;

    public function buscar($fechaini, $fechafin)
    {
        /**
         * Seleccionar los regitros q esten en el rango de fechas seleccionado.
         */
        $h = Hotel::all();
        $this->fechainicio = $fechaini. " " . date('H:i:s');
        $fechafin = $fechafin . " " . $h[0]->checkout;
    	$r = Registro::select('habitacion_id')
    				->whereBetween('fechaentrada', [$this->fechainicio, $fechafin])
    				->orWhere(function($query){
                        $query->whereRaw(DB::raw("'$this->fechainicio' between `fechaentrada` and `fechasalida`"));
                        })
    				->get();
    	$r = $r->toArray();

        
        if (count($r) != 0) {
            $hab_id_array = array();

            /**
             * Si se obtienen registros formar array con los id de las habitaciones ocupadas.
             */
            foreach ($r as $key => $regs) {
                foreach ($regs as $k => $habitacion_id)
                    array_push($hab_id_array, $habitacion_id);
            }
            //dd($hab_id_array);

            /**
             * Luego seleccionar Habitaciones que no esten en el array de habitaciones
             * ocupadas y que su estado sea diferente a reparación.
             */
            $habs = Habitacion::whereNotIn('id', $hab_id_array)
                              ->where('estado_id','!=', 3)
                              ->orderBy('habtipo_id', 'asc')
                              ->get();

            
        }
        else {
            /**
             * Si no se encuentran registros traer todas las habitaciones excepto 
             * las de estado 'Reparación'.
             */
            $habs = Habitacion::where('estado_id','!=', 3)
                              ->orderBy('habtipo_id', 'asc')
                              ->get();
            //                
        }

        if (count($habs->toArray()) != 0) {
            /**
             * Relacionar estado y tipo de Habitación.
             */
            $habs->each(function($habs){
                $habs->estado;
            });
            $habs->each(function($habs){
                $habs->habtipo;
            });

            $habs = $habs->toArray();
            /**
             * Obtener Habtipos y relacionar con Servivios internos 
             */
            $habtipos = Habtipo::where('activo', 1)->get();

            $habtipos->each(function($habtipos){
                $iconos=$habtipos->habtipo_serviciointernos;
                $habtipos->habtipo_serviciointernos->each(function($iconos){
                    $iconos->serviciointerno;
                });

            });

            $habtipos = $habtipos->toArray();

            /**
             * Si no se encuentran registros traer todas las habitaciones excepto 
             */
            foreach ($habs as $key => $hab) {
                foreach ($habtipos as $k => $habtipo) {
                    if ($habtipo['id'] == $hab['habtipo_id']) {
                        $habtipos[$k]['habitaciones'][] = $hab;
                    }
                    if (!(array_key_exists('habitaciones', $habtipos[$k]))) {
                        $habtipos[$k]['habitaciones'] = null;
                    }
                }
            }
            //dd($habtipos);
            $reservas = Reserva::whereIn('reservaestado_id', [2, 3])
                               ->where(function($query) use($fechafin){
                                    $query->whereBetween('fecha_inicio', [$this->fechainicio, $fechafin])
                                          ->orWhere(function ($q) {
                                            $q->whereRaw(DB::raw("'$this->fechainicio' between `fecha_inicio` and `fecha_fin`"));
                                          });
                                })
                                ->get();
            //dd($reservas->toArray());
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

                $disponibles = $habtipos[$k]['habitacionescount']-$habtipos[$k]['habtiporeservascount'];
                if ($disponibles > 0) 
                    $habtipos[$k]['disponibles'] = $disponibles;
                else
                    $habtipos[$k]['disponibles'] = 0;  

            }
            //dd($habtipos);
            return response()->json($habtipos);
        }
        else{
            return response()->json([
                "mensaje" => 'No se encontraron Habitaciones Disponibles'
            ]);
        }
    }
    public function registrosBusqueda($fechaini, $fechafin)
    {
        return response()->json($this->separadorDeFechas($fechaini, $fechafin, date('H:i:s')));
    }
    public function separadorDeFechas($fechaini, $fechafin, $initHour)
    {
        $fechaini = strtotime($fechaini . " 00:00:00");
        $fechafin = strtotime($fechafin . " 00:00:00");

        $h = Hotel::all();
        $hora = $h[0]->checkin;

        $disp = array();
        
        for($i = $fechaini; $i <= $fechafin; $i += 86400){
            //echo $i;
            $fechaN = date("Y-m-d", $i);
            if ($i == $fechaini){
                $fecha = date("Y-m-d", $i);
                $disp[] = $this->searchOptimized($fecha, $initHour, $hora);
            }
            else {
                if ($i == $fechafin){
                    $fecha = date("Y-m-d", $i);
                    $disp[] = $this->searchOptimized($fecha, $h[0]->checkout, $h[0]->checkout);
                }
                else{
                    $fecha = date("Y-m-d", $i);
                    $disp[] = $this->searchOptimized($fecha, $hora, $hora);
                }
            }
        }
        return $this->unionDisponibiidad($disp);
    }
    public function separadorDeFechas2($fechaini, $fechafin, $initHour)
    {
        $fechaini = strtotime($fechaini . " 00:00:00");
        $fechafin = strtotime($fechafin . " 00:00:00");

        $h = Hotel::all();
        $hora = $h[0]->checkin ;

        $disp = array();
        
        for($i = $fechaini; $i <= $fechafin; $i += 86400){
            //echo $i;
            $fechaN = date("Y-m-d", $i);
            if ($i == $fechaini){
                $fecha = date("Y-m-d", $i);
                $disp[] = $this->searchOptimized($fecha, $initHour, $hora);
            }
            else {
                if ($i == $fechafin){
                    $fecha = date("Y-m-d", $i);
                    $disp[] = $this->searchOptimized($fecha, $h[0]->checkout, $h[0]->checkout);
                }
                else{
                    $fecha = date("Y-m-d", $i);
                    $disp[] = $this->searchOptimized($fecha, $hora, $hora);
                }
            }
        }
        return $this->unionDisponibiidad($disp);
    }
    public function unionDisponibiidad($disp)
    {
        $cantPTH = array();
        foreach ($disp as $i => $habtipos) {
            foreach ($habtipos as $j => $habtipo) {
                $cantPTH[$j][$i] = $disp[$i][$j];
            }
        }
        $THmin = array();
        foreach ($cantPTH  as $j => $habtipos) {
            $menor = 999999999;
            $key = -1;
            foreach ($habtipos as $k => $habtipo) {
                $d = $habtipo['disponibles'];
                if ($d < $menor) {
                    $key = $k;
                    $menor = $d;
                }
            }
            $THmin[] = $habtipos[$key];
        }
        return $THmin;
    }
    public function searchOptimized($fecha, $hora, $checkin)
    {
        $fechab = $fecha . " " . $hora;
        $r = Registro::select('habitacion_id')
                     ->where(function($query)use($fechab){
                        $query->whereRaw(DB::raw("'$fechab' between `fechaentrada` and `fechasalida`"));
                        })
                     ->get();
        $r = $r->toArray();

        if (count($r) != 0) {
            $hab_id_array = array();
            foreach ($r as $key => $regs)
                array_push($hab_id_array, $regs['habitacion_id']);
            
            $habs = Habitacion::whereNotIn('id', $hab_id_array)
                              ->where('estado_id','!=', 3)
                              ->orderBy('habtipo_id', 'asc')
                              ->get();
        }
        else {

            $habs = Habitacion::where('estado_id','!=', 3)
                              ->orderBy('habtipo_id', 'asc')
                              ->get();           
        }

        $habtipos = Habtipo::where('activo', 1)->get();

         $habtipos->each(function($habtipos){
                $iconos=$habtipos->habtipo_serviciointernos;
                $habtipos->habtipo_serviciointernos->each(function($iconos){
                    $iconos->serviciointerno;
                });

            });
        if (count($habs->toArray()) != 0) {

            $habs->each(function($habs){
                $habs->estado;
            });

            $habtipos = $habtipos->toArray();
            foreach ($habs as $key => $hab) {
                foreach ($habtipos as $k => $habtipo) {
                    if ($habtipo['id'] == $hab['habtipo_id']) {
                        $habtipos[$k]['habitaciones'][] = $hab;
                    }
                    if (!(array_key_exists('habitaciones', $habtipos[$k]))) {
                        $habtipos[$k]['habitaciones'] = null;
                    }
                }
            }
        }
        $fechaBR = $fecha . " " . $checkin;
        $reservas = Reserva::whereIn('reservaestado_id', [2, 3])
                           ->where(function($query)use($fechaBR){
                                $query->whereRaw(DB::raw("'$fechaBR' between `fecha_inicio` and `fecha_fin`"));
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
                $habtipos[$k]['habtiporeservascount'] = 0;

            if (count($habs) != 0) {
                $r2 = count($habtipo['habitaciones']);
                $habtipos[$k]['habitacionescount'] = $r2;
            }
            else{
                $habtipos[$k]['habitacionescount'] = 0;
            }
            $disponibles = $habtipos[$k]['habitacionescount']-$habtipos[$k]['habtiporeservascount'];
            
            $habtipos[$k]['disponibles'] = $disponibles;
            

            //unset($habtipos[$k]['habitaciones']);
        }

        return $habtipos;

    }

    public function store(Request $request)
    {
        $registro = new Registro();
        $registro->usuario_id = Auth::user()->id;
        $registro->habitacion_id = $request->habitacion_id;
        $registro->fechaentrada = date('Y-m-d H:i:s');
        $registro->fechasalida = $request->fechafin. " " . Auth::user()->empleado->hotel->checkout;

        if ($request->codigo_reserva)
             $registro->codigo_reserva = $request->codigo_reserva;

        $dias = (strtotime($request->fechaini)-strtotime($request->fechafin))/86400;
        $dias = abs($dias);
        $dias = floor($dias);

        $registro->total = $this->calcularTotal($dias, $request->habitacion_id);

        $registro->save();

        $this->cambiarEstadoHabs($registro->habitacion_id);

        return response()->json([
            "mensaje" => 'Registro Creado'
        ]);
    }

    public function calcularTotal($dias, $habitacion_id)
    {
        $hab = Habitacion::find($habitacion_id);
        $hab->habtipo;
        $total = $hab->habtipo->precio * $dias;

        return $total;
    }
    
    public function cambiarEstadoHabs($id)
    {
        $hab = Habitacion::find($id);
        $hab->estado_id = 2;
        $hab->save();
    }

    public static function registrosDeHoy()
    {   
        $h = Hotel::all();
        self::$fechaInicio = date("Y-m-d")." ".$h[0]->checkin;
        $r = Registro::whereBetween('fechaentrada', [ self::$fechaInicio, date("Y-m-d") ." 11:59:59"])
                     ->orWhere(function($query){
                        $query->whereRaw(DB::raw("'".self::$fechaInicio."' between fechaentrada and fechasalida"));
                        })
                     ->get();

        $r->each(function($r){
            $r->regclientes;
            $regclientes = $r->regclientes;
            $r->regclientes->each(function($regclientes){
                $regclientes->cliente;
            });
        });

        $r = $r->toArray();

        return $r;
    }
    public function getRegistro($id)
    {
        $registro = Registro::where('id', $id)
                            ->get();
        $registro->each(function($registro){
            $registro->regclientes;
            $regclientes = $registro->regclientes;
            $registro->regclientes->each(function($regclientes){
                $regclientes->cliente;
            });

        });
        $registro->each(function($registro) {
            $registro->habitacion;
            $registro->habitacion->habtipo;
        });

        return response()->json($registro);
    }
    public function finalizar($id)
    {
        $registro = Registro::find($id);
    
        $registro->fechasalida = date("Y-m-d H:i:s");
        $registro->save();

        $registro->habitacion;

        $hab = Habitacion::find($registro->habitacion->id);
        $hab->estado_id = 1;
        $hab->save();

        return response()->json([
            "mensaje" => 'Admin#/Habitaciones'
        ]);
    }
    public function getRegistros($fechaini, $fechafin)
    {
        $regs = Registro::select('id')->whereBetween('fechaentrada', [$fechaini . " 00:00:00", $fechafin . " 23:59:59"])->get();
        $regs_id = array();
        foreach ($regs->toArray() as $key => $reg) {
            foreach ($reg as $k => $id)
                array_push($regs_id, $id);
        }
        
        $regsClientes = Regcliente::whereIn('registro_id', $regs_id)->get();
    
        $regsClientes->each(function($regsClientes) {
            $regsClientes->registro;
            $regsClientes->registro->habitacion;
            $regsClientes->cliente;
        });

        return response()->json( $regsClientes );
    }

    public function grillaDisponibilidad($fechaini, $fechafin)
    {
        $fechaInicio = strtotime($fechaini . " 00:00:00");
        $fechaFin = strtotime($fechafin . " 23:59:59");

        $h = Hotel::all();

        //$hora = strtotime ( '+1 minute' , strtotime ( $h[0]->checkout ) ) ;
        //$hora = date('H:i:s', $hora); 
        $hora = $h[0]->checkin ;

        $disp = array();
        
        for($i = $fechaInicio; $i <= $fechaFin; $i += 86400){
            $fechaN = date("Y-m-d", $i);
            if ($i == $fechaInicio){
                $fecha = date("Y-m-d", $i);
                $disp[$fechaN] = $this->getDisp($fecha, date('H:i:s'), $hora);
            }
            else{
                $fecha = date("Y-m-d", $i);
                $disp[$fechaN] = $this->getDisp($fecha, $hora, $hora);
            }
        }
        return response()->json( $disp );
    }
    public function getDisp($fecha, $hora, $checkin)
    {
            $fechab = $fecha . " " . $hora;
            $r = Registro::select('habitacion_id')
                    ->where(function($query)use($fechab){
                        $query->whereRaw(DB::raw("'$fechab' between `fechaentrada` and `fechasalida`"));
                        })
                    ->where(function($query)use($fechab){
                        $query->whereRaw(DB::raw("'$fechab' not between DATE_FORMAT(fechasalida,'%Y-%m-%d 00:00:00') and `fechasalida`"));
                        })
                    ->get();
            $r = $r->toArray();

            if (count($r) != 0) {
            $hab_id_array = array();

            /**
             * Si se obtienen registros formar array con los id de las habitaciones ocupadas.
             */
            foreach ($r as $key => $regs) {
                foreach ($regs as $k => $habitacion_id)
                    array_push($hab_id_array, $habitacion_id);
            }
            //dd($hab_id_array);

            /**
             * Luego seleccionar Habitaciones que no esten en el array de habitaciones
             * ocupadas y que su estado sea diferente a reparación.
             */
            $habs = Habitacion::whereNotIn('id', $hab_id_array)
                              ->where('estado_id','!=', 3)
                              ->orderBy('habtipo_id', 'asc')
                              ->get();
            }
            else {
                /**
                 * Si no se encuentran registros traer todas las habitaciones excepto 
                 * las de estado 'Reparación'.
                 */
                $habs = Habitacion::where('estado_id','!=', 3)
                                  ->orderBy('habtipo_id', 'asc')
                                  ->get();
                //                
            }

            $habtipos = Habtipo::where('activo', 1)->get();

            if (count($habs->toArray()) != 0) {
                /**
                 * Obtener Habtipos y relacionar con Servivios internos 
                 */

                $habtipos = $habtipos->toArray();

                /**
                 * Si no se encuentran registros traer todas las habitaciones excepto 
                 */
                foreach ($habs as $key => $hab) {
                    foreach ($habtipos as $k => $habtipo) {
                        if ($habtipo['id'] == $hab['habtipo_id']) {
                            $habtipos[$k]['habitaciones'][] = $hab;
                        }
                        if (!(array_key_exists('habitaciones', $habtipos[$k]))) {
                            $habtipos[$k]['habitaciones'] = null;
                        }
                    }
                }
            }
            
            //dd($habtipos);
            $fechaBR = $fecha . " " . $checkin;
            $reservas = Reserva::whereIn('reservaestado_id', [2, 3])
                              ->where(function($query)use($fechaBR){
                                $query->whereRaw(DB::raw("'$fechaBR' between `fecha_inicio` and `fecha_fin`"));
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
                    $habtipos[$k]['habtiporeservascount'] = 0;

                if (count($habs) != 0) {
                    $r2 = count($habtipo['habitaciones']);
                    $habtipos[$k]['habitacionescount'] = $r2;
                }
                else{
                    $habtipos[$k]['habitacionescount'] = 0;
                }

                $disponibles = $habtipos[$k]['habitacionescount']-$habtipos[$k]['habtiporeservascount'];
                if ($disponibles > 0) 
                    $habtipos[$k]['disponibles'] = $disponibles;
                else
                    $habtipos[$k]['disponibles'] = 0;

                unset($habtipos[$k]['habitaciones']);
            }
            return $habtipos;
    }
    public function getRegistroHab($id)
    {
        $registros = Registro::select('id')
                             ->where('habitacion_id', $id)
                             ->orderBy('id', 'desc')
                             ->get();
        return response()->json( $registros );
    }
}