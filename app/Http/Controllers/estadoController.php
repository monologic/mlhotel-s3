<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Estado;

class EstadoController extends Controller
{
	public function getEstados()
	{
		$estados = Estado::all();
        $estados = $estados ->toArray();
        return response()->json( $estados );
	}
}