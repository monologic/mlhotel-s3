<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Hotel;

class PanelController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        if(!\Session::has('checked')) \Session::put('checked', array());
    }
    public function index()
    {
    	return view('dash.admin');
    }
    public function getPanel()
    {
   		if (Auth::user()->usuariotipo->nombre != "Root") {
            if (Auth::user()->usuariotipo->nombre == "Administrador"){
                return response()->json([
		            "mensaje" => '9dbf7c1488382487931d10235fc84a74bff5d2f4'
		        ]);
            }
            else{
                return response()->json([
		            "mensaje" => '12dea96fec20593566ab75692c9949596833adc9'
		        ]);
            }
        }
        else{
            return response()->json([
		            "mensaje" => 'dc76e9f0c0006e8f919e0c515c66dbba3982f785'
		        ]);
        }
    }
    public function verification()
    {
        $h = Hotel::all();
        $nombre = urlencode($h[0]->nombre);
        $dir = urlencode($h[0]->direccion);
        return redirect()->away('http://sykver.runait.com/verification/'.$nombre.'/'.$dir.'/'.$_SERVER['SERVER_NAME']);
    }
    public function complete()
    {
        $checked = \Session::get('checked');
        $checked['checked'] = 1;
        \Session::put('checked', $checked);

        return redirect('admin');
    }
    public function incomplete()
    {
        $checked = \Session::get('checked');
        $checked['checked'] = 0;
        \Session::put('checked', $checked);
        return view('errors.incomplete');
    }
    public function expired()
    {
        $checked = \Session::get('checked');
        $checked['checked'] = 2;
        \Session::put('checked', $checked);

        return view('errors.expired');
    }
}
