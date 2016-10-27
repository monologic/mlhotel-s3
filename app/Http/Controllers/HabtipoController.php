<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Habtipo;
use App\Serviciointerno;
use App\habtipo_serviciointerno;

class HabtipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.habitaciones');
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
        $tipohab = $id;
        $tipohab->fill($request->all());
        $tipohab->save();
        $resp = $this->getHabtipo();

        return $resp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {
        $id->activo = 0;
        $id->save();

        return $this->getHabtipo();

    }
    public function solo($id)
    {
        $Habtipos = Habtipo::where('id', $id)->get();
         $Habtipos->each(function($Habtipos){
            $Habtipos->habtipofotos;
            $iconos=$Habtipos->habtipo_serviciointernos;
            $Habtipos->habtipo_serviciointernos->each(function($iconos){
                $iconos->serviciointerno;
            });

        });
         //dd($Habtipos);
        return view('home.habitacion')->with('datos', $Habtipos);
    }

      public function HabitacionesStore(Request $request)
    {
       if($request->file('imagen'))
        {
            $file = $request -> file('imagen');
            $name = 'Habtipo_'. time() . '.' .$file->getClientOriginalExtension();
            $path=public_path() . "/imagen/habitaciones/";
            $file -> move($path,$name);
        }
        $Habtipo = new Habtipo($request->all());
        $Habtipo->foto = $name;
        $Habtipo->activo = 1;
        $Habtipo->save();
        $idhab=$Habtipo->id;
         //return redirect('admin#/LisHab');        
        $servicios= Serviciointerno::select('id')->get();
        $servicios=$servicios->toArray();
        foreach ($servicios as $key => $servicio) {
             $htsi = new habtipo_serviciointerno();
             $htsi->estado = 'false';
             $htsi->habtipo_id=$idhab;
             $htsi->serviciointerno_id=$servicio['id'];
             $htsi->save();   
        }
        return redirect('admin#/LisHab');  
    }
    public function getHabtipo()
    {   
        $Habtipos = Habtipo::where('activo', 1)->get();
         $Habtipos->each(function($Habtipos){
            $iconos=$Habtipos->habtipo_serviciointernos;
            $Habtipos->habtipo_serviciointernos->each(function($iconos){
                $iconos->serviciointerno;
            });

        });
        $Habtipos = $Habtipos ->toArray();
        return response()->json( $Habtipos );
    }
     public function getIconos($id)
    {   
        $Habtipos = Habtipo::where( [
                            ['id',$id],
                            ['activo',1],
                        ])->get();
        $Habtipos->each(function($Habtipos){
          $Habtipos->habtipofotos;
        });
        $Habtipos = $Habtipos ->toArray();
        return response()->json( $Habtipos );
    }
    public function getHabtipos()
    {
        $Habtipos = Habtipo::where('activo', 1)->get();
        $Habtipos = $Habtipos ->toArray();
        return response()->json( $Habtipos );
    }

     public function getHabitaciones($id)
    {   

        $Habtipos = Habtipo::where( [
                            ['id',$id],
                            ['activo',1],
                        ])->get();
        $Habtipos->each(function($Habtipos){
            $Habtipos->habtipofotos;
            $iconos=$Habtipos->habtipo_serviciointernos;
            $Habtipos->habtipo_serviciointernos->each(function($iconos){
                $iconos->serviciointerno;
            });

        });
        $Habtipos = $Habtipos ->toArray();
        return response()->json( $Habtipos );
    }

    public function dataEditar(Request $request)
    {
        
        $url = explode("=", $request->url['hash']);
        dd($url[1]);
    }
    public function editar($id_servicio, $id_habtipo){
        
    }
}
