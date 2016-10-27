<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;

use App\Hotel;
use App\Empleado;
use App\Emptipo;
use App\Usuario;
use App\Usuariotipo;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotel = Hotel::all();
        //$hotel = $hotel->toArray();
        //dd($hotel);
        return view('home.contacto')->with('datos', $hotel);
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
        $hotel = new Hotel($request->all());
        $hotel->save();

        return $this->getHoteles();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
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
        //dd($request);
        $hotel = Hotel::find($id);
        $hotel->fill($request->all());
        $hotel->save();

        $res = $this->getHoteles();

        return $res;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Hotel::destroy($id);

        return $this->getHoteles();
    }

    public function getHoteles()
    {
        $hoteles = Hotel::all();

        $hoteles = $hoteles->toArray();

        foreach ($hoteles as $key => $hotel) {
            $adm = $this->getAdministrador( $hotel['id'] );
            $hoteles[$key]['administrador'] = $adm;

        }

        return response()->json( $hoteles );
    }

    public function getAdministrador($hotel_id)
    {
        $id_adm = $this->getIdCargoAdminHotel();

        $adm = Empleado::where([
                    ['hotel_id', $hotel_id],
                    ['emptipo_id', $id_adm],
                ])->get();
        
    
        if (count($adm) > 0) {
            $adm[0]->usuario; 
            $adm = $adm->toArray();
            return $adm[0];
        }
        else {
            return $adm[0] = null;
        }
    }

    public function getIdCargoAdminHotel()
    {
        $id_adm = Emptipo::select('id')->where('tipo', 'Administrador')->get();
        $id_adm = $id_adm->toArray();
        $id_adm = $id_adm[0]['id'];

        return $id_adm;
    }
    public function getIdTipoUsuarioAdminHotel()
    {
        $id_tua = Usuariotipo::select('id')->where('nombre', 'Administrador')->get();
        $id_tua = $id_tua->toArray();
        $id_tua = $id_tua[0]['id'];

        return $id_tua;
    }

    public function crearAdminHotel(Request $request)
    {
        $empleado = new Empleado($request->all());
        $empleado->save();

        $usuario = new Usuario();
        $usuario->empleado_id = $empleado->id;
        $usuario->usuario = $request->usuario;
        $usuario->password = bcrypt($request->password);
        $usuario->activo = 1;
        $usuario->usuariotipo_id = 2;
        $usuario->save();

        return $this->getHoteles();
    }

    public function crearUsuario($nom, $ape)
    {
        $n = explode(" ", $nom);
        $a = explode(" ", $ape);
        $usuario = $n[0] . $a[0];

        return $usuario;
    }

    public function guardarAdminHotel(Request $request)
    {
        $e = Empleado::find($request->empleado);
        $e->emptipo_id = 2;
        $e->save();

        $u = Usuario::where('empleado_id', $request->empleado)->get();

        if ($u->count() > 0) {
            $user = Usuario::find($u[0]->id);
            $user->usuariotipo_id = 3;
            $user->activo = 0;
            $user->save();
            //dd("Eliminando");
        }

        $empleado = new Empleado($request->all());
        $empleado->save();

        $usuario = new Usuario();
        $usuario->empleado_id = $empleado->id;
        $usuario->usuario = $request->usuario;
        $usuario->password = bcrypt($request->password);
        $usuario->activo = 1;
        $usuario->usuariotipo_id = 2;
        $usuario->save();

        return $this->getHoteles();
    }

    public function dataEditar(Request $request)
    {
        $url = explode("=", $request->url['hash']);
        dd($url[1]);
    }

    public function getHotelesSimple()
    {
        $hoteles = Hotel::all();
        return response()->json( $hoteles->toArray() );   
    }
     public function getHotelesFooter()
    {
        $hotel = Hotel::orderBy('id', 'asc')->get();
        $hotel = $hotel->toArray();
        //Sdd($hotel);
        return response()->json( $hotel[0] );   
    }

    public function configHoraHotel(Request $request)
    {
        $hotel = Hotel::find(Auth::user()->empleado->hotel->id);

        $hotel->checkin = $request->checkin;
        $hotel->checkout = $request->checkout;

        $hotel->save();

        return response()->json([
            "mensaje" => 'Se ha modificado la hora de Ingreso y Salida'
        ]);
    }

    public function getHotel()
    {
        $hotel = Hotel::find(Auth::user()->empleado->hotel->id);
        return response()->json( $hotel );  
    }
    public function updateAdmin(Request $request, $id)
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
        return $this->getHoteles();
    }

    public function updateAdminHotel(Request $request, $id)
    {
        $empleado = Empleado::find($id);
        $empleado->fill($request->all());
        $empleado->save();

        return $this->getHoteles();
    }
}