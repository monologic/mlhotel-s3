<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Categoria;
use App\Servicio;
use App\Mainservice;

class categoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $main=Mainservice::all();
        $Servicios = Categoria::where('activo', 1)->get();
        $Servicios->each(function($Servicios){
            $Servicios->servicios;
        });
        $general[] =$main;
        $general[] =$Servicios;
        //dd($general);
        return view('home.servicios')->with('datos', $general);
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
        $categoria = Categoria::find($id);
        $categoria->fill($request->all());
        $categoria->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $categoria = Categoria::find($id);
        $categoria->activo = 0;
        $categoria->save();
    }

    public function ServiceCreateIndex(Request $request)
    {
        
      if($request->file('foto'))
        {
            $file = $request -> file('foto');
            $name = 'servicio_'. time() . '.' .$file->getClientOriginalExtension();
            $path=public_path() . "/imagen/sliders/";
            $file -> move($path,$name);
        }
        $categoria = new Categoria($request->all());
        $categoria->foto = $name;
        $categoria->activo = 1;
        $categoria->save();
         return redirect('admin#/LisServicios');
    }
     public function getServices()
    {
        $Servicios = Categoria::where('activo', 1)->get();
        $Servicios->each(function($Servicios){
            $Servicios->servicios;
        });
        
        $Servicios = $Servicios ->toArray();
        return response()->json( $Servicios );
    }
     public function getServicesompletoC($id)
    {
        $Servicios = Categoria::where( [
                            ['id',$id],
                            ['activo',1],
                        ])->get();
        $Servicios->each(function($Servicios){
            $Servicios->servicios;
        });
        $Servicios = $Servicios->toArray();
        return response()->json( $Servicios );
    }

    public function ServiceCreateforCategory(Request $request)
    {
        
      if($request->file('foto'))
        {
            $file = $request -> file('foto');
            $name = 'servicio_cat'. time() . '.' .$file->getClientOriginalExtension();
            $path=public_path() . "/imagen/Categoria/";
            $file -> move($path,$name);
        }
        $servicioC = new Servicio($request->all());
        $servicioC->foto = $name;
        $servicioC->save();
         return redirect('admin#/Servicios/' . $servicioC->categoria_id);
    }
    public function editarMainService(Request $request)
    {
        if($request->file('imagen')){
            $file = $request->file('imagen');
            $name = 'servicio_main'. time() . '.' .$file->getClientOriginalExtension();
            $path = public_path() . "/imagen/Categoria/main/";
            $file->move($path,$name);
        }
        $sm = Mainservice::find(1);
        $sm->nombre = $request->nombre;
        $sm->contenido = $request->contenido;
        $sm->imagen = $name;
        $sm->save();
        return redirect('admin#/LisServicios');
    }

}
