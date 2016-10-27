<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Registro;
use App\Habitacion;
use App\Habtipo;
use App\Reserva;
use App\Habtiporeserva;
use App\Cliente;
use App\Hotel;

class carritoController extends Controller
{
    public $fechainicio;
    static $fechaInicio;

    public function __construct()
    {
        if(!\Session::has('fechas')) \Session::put('fechas', array());
        if(!\Session::has('cart')) \Session::put('cart', array());
        if(!\Session::has('cliente')) \Session::put('cliente', array());
        if(!\Session::has('porcentaje')) \Session::put('porcentaje', array());
    }
    public function index()
    {
        return view('home.car');
    }
    public function buscarHabitaciones($fechaini, $fechafin)
    {
        
        $dias = (strtotime($fechaini)-strtotime($fechafin))/86400;
        $dias = abs($dias); 
        $dias = floor($dias);

        $fechas = \Session::get('fechas');
        $fechas['fecha_inicio'] = $fechaini;
        $fechas['fecha_fin'] = $fechafin;
        $fechas['dias'] = $dias;
        \Session::put('fechas', $fechas);
        \Session::forget('cart'); 
        
        $h = Hotel::all();
        
        $cregistro = new RegistroController();
        return response()->json($cregistro->separadorDeFechas2($fechaini, $fechafin, $h[0]->checkin));
        
    }

    // Show cart
    public function show()
    {
        $cart = \Session::get('cart');
        //$total = $this->total();
        //return view('store.cart', compact('cart', 'total'));
        //dd($cart);
        $cartRet = $cart;
        return response()->json( $cartRet );
    }

    public function getDias()
    {
        $cart = \Session::get('fechas');
        //$total = $this->total();
        //return view('store.cart', compact('cart', 'total'));
        //dd($cart);
        $fechas = $cart;
        return response()->json( $fechas );
    }
    public static function getDias2()
    {
        $cart = \Session::get('fechas');
        //$total = $this->total();
        //return view('store.cart', compact('cart', 'total'));
        //dd($cart);
        $fechas = $cart;
        return $fechas;
    }
    // Add item
    public function add(Habtipo $Habtipo, $max)
    {
        $cart = \Session::get('cart');
        $Habtipo->quantity = 1;
        $Habtipo->max = $max;
        $cart[$Habtipo->id] = $Habtipo;
        \Session::put('cart', $cart);

        //return redirect()->route('cart-show');
    }

    // Delete item
    public function delete(Habtipo $Habtipo)
    {
        $cart = \Session::get('cart');
        unset($cart[$Habtipo->id]);
        \Session::put('cart', $cart);

        //return redirect()->route('cart-show');
    }

    // Update item
    public function update(Habtipo $Habtipo, $quantity)
    {
        $cart = \Session::get('cart');
        $cart[$Habtipo->id]->quantity = $quantity;
        \Session::put('cart', $cart);

        //return redirect()->route('cart-show');
    }

    // Trash cart
    public function trash()
    {
        \Session::forget('cart');
        \Session::forget('fechas');
        \Session::forget('cliente');
        \Session::forget('porcentaje');
        //return redirect()->route('cart-show');
    }

    // Total
    private function total()
    {
        $cart = \Session::get('cart');
        $total = 0;
        foreach($cart as $item){
            $total += $item->price * $item->quantity;
        }

        return $total;
    }

    // Detalle del pedido
    public function orderDetail()
    {
        if(count(\Session::get('cart')) <= 0) return redirect()->route('home');
        $cart = \Session::get('cart');
        $total = $this->total();

        return view('store.order-detail', compact('cart', 'total'));
    }

    //Guardar Cliente en BD y Session
    public function guardarCliente(Request $request)
    {
        $c = Cliente::where('dni', $request->dni)->get();
        if ($c->count() == 0) {
            $cli = new Cliente($request->all());
            $cli->save();
        }
        else{
            $cli = $c[0];
            $cli->email = $request->email;
            $cli->save();
        }

        $cliente = \Session::get('cliente');
        $cliente['id'] = $cli->id;
        \Session::put('cliente', $cliente);

        $cliente = \Session::get('cliente');
        $cliente['id'] = $cli->id;
        $cliente['email'] = $request->email;
        $cliente['banco_id'] = $request->banco_id;

        \Session::put('cliente', $cliente);

        $porcentaje = \Session::get('porcentaje');
        $porcentaje['porcentaje'] = $request->porcentaje;
        \Session::put('porcentaje', $porcentaje);
    }

    /*
    public function addCarrito(Request $request){

        $carrito = $request->all();
            $arreglo=Session::get('car.items');
            $encontro=false;
            $numero=0;

            for($i=0;$i<count($arreglo);$i++){
                if ($arreglo[$i]['id']==$request->id) {
                    $encontro=true;
                    $numero=$i;
                }
            }
            if (!$encontro) {
                Session::push('car.items',$carrito);
            }
        
    }
    public function getCar(){

        return response()->json( Session::get('car') );
    }
    */
}
