<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;

class estadisticaController extends Controller
{
    public function getAll($month, $year)
    {
    	$data = array();

    	$ht = $this->getHabtipos();

    	$data['arribosPorDia'] = $this->getArribosPorDia($month, $year);
    	$data['arribosPorTipo'] = $this->completarHabtipos($this->getArribosPorTipo($month, $year), $ht, 'arribos');
    	$data['habOcupadasPorNoche'] = $this->completarHabtipos($this->getHabitacionesOcupadasPorNoche($month, $year), $ht, 'habitaciones_noche');
    	$data['pernoctacionesPorTipo'] = $this->completarHabtipos($this->getPernoctacionesPorTipo($month, $year), $ht, 'pernoctaciones_tipo');
    	$data['arriposPorPais'] = $this->getArribosPorPais($month, $year);
    	$data['pernoctacionesPorPais'] = $this->getPernoctacionesPorPais($month, $year);
    	$data['arribosPorRegion'] = $this->getArribosPorRegion($month, $year);
    	$data['pernoctacionesPorRegion'] = $this->getPernoctacionesPorRegion($month, $year);

    	return response()->json( $data );

    }
    public function getArribosPorDia($month, $year)
    {
    	$r = \DB::table('regclientes')
    	          ->select(DB::raw('registros.fechaentrada, COUNT(regclientes.registro_id) as arribos'))
    	          ->join('registros', 'regclientes.registro_id', '=', 'registros.id')
    	          ->whereRaw("MONTH(registros.fechaentrada)=$month and YEAR(registros.fechaentrada)=$year")
    	          ->groupBy(DB::raw('DAY(registros.fechaentrada)'))
    	          ->get();

    	return $r;
    }
    public function getArribosPorTipo($month, $year)
    {
    	$r = \DB::table('regclientes')
    	          ->select(DB::raw('habtipos.nombre,COUNT(regclientes.registro_id) as arribos'))
    	          ->join('registros', 'regclientes.registro_id', '=', 'registros.id')
    	          ->join('habitacions', 'registros.habitacion_id', '=', 'habitacions.id')
    	          ->join('habtipos', 'habitacions.habtipo_id', '=', 'habtipos.id')
    	          ->whereRaw("MONTH(registros.fechaentrada)=$month and YEAR(registros.fechaentrada)=$year")
    	          ->groupBy(DB::raw('habtipos.nombre'))
    	          ->get();
    	return $r;
    }
    public function getHabtipos()
    {
    	$r = \DB::table('habtipos')->select('habtipos.nombre')->where('activo', 1)->get();
    	return $r;
    }
    public function completarHabtipos($r, $ht, $key)
    {
    	foreach ($ht as $k => $htt) {
    		$count = 0;
    		foreach ($r as $j => $htr) {
    			if ($htr->nombre == $htt->nombre) {
    				$count = $htr->$key;
    			}
    		}
    		if ($count == 0)
    			$ht[$k]->$key = 0;
    		else
    			$ht[$k]->$key = $count;
    	}
    	return $ht;
    }
    public function getHabitacionesOcupadasPorNoche($month, $year)
    {
    	$r = \DB::table('registros')
    	          ->select(DB::raw('habtipos.nombre, SUM(DATEDIFF(registros.fechasalida,registros.fechaentrada)) as habitaciones_noche'))
    	          ->join('habitacions', 'registros.habitacion_id', '=', 'habitacions.id')
    	          ->join('habtipos', 'habitacions.habtipo_id', '=', 'habtipos.id')
    	          ->whereRaw("MONTH(registros.fechaentrada)=$month and YEAR(registros.fechaentrada)=$year")
    	          ->groupBy(DB::raw('habtipos.nombre'))
    	          ->get();

    	return $r;
    }
    public function getPernoctacionesPorTipo($month, $year)
    {
    	$r = \DB::table('registros')
    	          ->select(DB::raw('habtipos.nombre, SUM((SELECT COUNT(*) FROM regclientes WHERE regclientes.registro_id = registros.id)*DATEDIFF(registros.fechasalida,registros.fechaentrada)) as pernoctaciones_tipo'))
    	          ->join('habitacions', 'registros.habitacion_id', '=', 'habitacions.id')
    	          ->join('habtipos', 'habitacions.habtipo_id', '=', 'habtipos.id')
    	          ->whereRaw("MONTH(registros.fechaentrada)=$month and YEAR(registros.fechaentrada)=$year")
    	          ->groupBy(DB::raw('habtipos.nombre'))
    	          ->get();
    	
    	return $r;          
    }
    public function getArribosPorPais($month, $year)
    {
    	$r = \DB::table('regclientes')
    	          ->select(DB::raw('clientes.pais, COUNT(regclientes.registro_id) as arribos'))
    	          ->join('registros', 'regclientes.registro_id', '=', 'registros.id')
    	          ->join('clientes', 'regclientes.cliente_id', '=', 'clientes.id')
    	          ->whereRaw("MONTH(registros.fechaentrada)=$month and YEAR(registros.fechaentrada)=$year")
    	          ->groupBy(DB::raw('clientes.pais'))
    	          ->get();

    	return $r;       
    }
    public function getPernoctacionesPorPais($month, $year)
    {
    	$r = \DB::table('registros')
    	          ->select(DB::raw('clientes.pais, Sum((SELECT COUNT(*) FROM regclientes WHERE regclientes.registro_id = registros.id)*DATEDIFF(registros.fechasalida,registros.fechaentrada)) AS pernoctaciones_pais'))
    	          ->join('regclientes', 'regclientes.registro_id', '=', 'registros.id')
    	          ->join('clientes', 'regclientes.cliente_id', '=', 'clientes.id')
    	          ->whereRaw("MONTH(registros.fechaentrada)=$month and YEAR(registros.fechaentrada)=$year")
    	          ->groupBy(DB::raw('clientes.pais'))
    	          ->get();

    	return $r;          
    }
    public function getArribosPorRegion($month, $year)
    {
    	$r = \DB::table('regclientes')
    	          ->select(DB::raw('clientes.ciudad, COUNT(regclientes.registro_id) as arribos'))
    	          ->join('registros', 'regclientes.registro_id', '=', 'registros.id')
    	          ->join('clientes', 'regclientes.cliente_id', '=', 'clientes.id')
                  ->where('pais', 'Perú')
    	          ->whereRaw("MONTH(registros.fechaentrada)=$month and YEAR(registros.fechaentrada)=$year")
    	          ->groupBy(DB::raw('clientes.ciudad'))
    	          ->get();

    	return $r;          
    }
    public function getPernoctacionesPorRegion($month, $year)
    {
    	$r = \DB::table('registros')
    	          ->select(DB::raw('clientes.ciudad, Sum((SELECT COUNT(*) FROM regclientes WHERE regclientes.registro_id = registros.id)*DATEDIFF(registros.fechasalida,registros.fechaentrada)) AS pernoctaciones_pais'))
    	          ->join('regclientes', 'regclientes.registro_id', '=', 'registros.id')
    	          ->join('clientes', 'regclientes.cliente_id', '=', 'clientes.id')
    	          ->whereRaw("MONTH(registros.fechaentrada)=$month and YEAR(registros.fechaentrada)=$year")
    	          ->groupBy(DB::raw('clientes.ciudad'))
    	          ->get();

    	return $r;          
    }

}
