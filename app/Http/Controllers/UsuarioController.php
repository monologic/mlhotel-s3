<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Usuario;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = \DB::table('usuarios')
                       ->join('empleados', 'empleados.id', '=', 'usuarios.empleado_id')
                       ->join('usuariotipos', 'usuariotipos.id', '=', 'usuarios.usuariotipo_id')
                       ->join('emptipos', 'emptipos.id', '=', 'empleados.emptipo_id')
                       ->select('usuarios.*', 'empleados.nombres', 'empleados.apellidos', 'usuariotipos.nombre as usuariotipo', 'emptipos.tipo as tipoempleado' )
                       ->where('empleados.hotel_id',\Auth::user()->empleado->hotel->id)
                       ->get();

        return response()->json( $usuarios );          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuario = new Usuario($request->all());
        $usuario->password = bcrypt($request->password);
        $usuario->activo = 1;
        $usuario->save();

        $empController = new empleadoController();
        return redirect('admin#//804ee937289b6ca7015c3230d5f2eaae7a51411c');
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
        $usuario = Usuario::find($id);
        $req = $request->all();
        if (array_key_exists('usuario', $req)) {
            $usuario->usuario = $request->usuario;
            $usuario->usuariotipo_id = $request->usuariotipo_id;
        }
        if (array_key_exists('password', $req)) {
            $usuario->password = bcrypt($request->password);
        }
        $usuario->save();
        $empController = new empleadoController();
        return $empController->getEmpleadosFull();
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

    public function activarDesactivar($id)
    {
        $usuario = Usuario::find($id);
        if ($usuario->activo == 1) {
            $usuario->activo = 0;
        }
        else{
            $usuario->activo = 1;
        }

        $usuario->save();

        $empController = new empleadoController();
        return $empController->getEmpleadosFull();
    }

    public function getUsuario()
    {
        $usuario = Usuario::find(\Auth::user()->id);
        return response()->json( $usuario );
    }
    public function disponibilidadUsuario($usuario)
    {
        $a = Usuario::count()->where('usuario', $usuario)->get();
    }
}
