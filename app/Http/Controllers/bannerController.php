<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Slider;
use App\Ico;
use App\Habtipo;
use App\Noticia;

class bannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Sliders = Slider::where('estado', 'activo')->orderBy('orden', 'asc')->get();
        $iconos = Ico::all();
        $Habtipos = Habtipo::where('activo', 1)->get();
        $Noticias = Noticia::orderBy('fecha','DESC')->take(3)->get();

        $general[] =$Sliders;
        $general[] =$iconos;
        $general[] =$Habtipos;
        $general[] =$Noticias;
        return view('home.home')->with('datos', $general);
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
        
        $banner = Slider::find($id);
        $banner->fill($request->all());
        $banner->save();
        $res = $this->getBanners2();

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
        Slider::destroy($id);

        return $this-> getBanners();
        return redirect('#/LisBanner');
    }
    public function sliderCreateIndex(Request $request)
    {
        
      if($request->file('imagen'))
        {
            $file = $request -> file('imagen');
            $name = 'slider_'. time() . '.' .$file->getClientOriginalExtension();
            $path=public_path() . "/imagen/sliders/";
            $file -> move($path,$name);
        }
        $slider = new Slider($request->all());

        $slider->imagen = $name;
         $slider->save();
         return redirect('admin#/LisBanner');


    }
    public function getBanners()
    {
        $Sliders = Slider::where('estado', 'activo')->orderBy('orden', 'asc')->get();
        $Sliders = $Sliders ->toArray();


        return response()->json( $Sliders );
    }
     public function getBanners2()
    {
        $Sliders = Slider::orderBy('orden', 'asc')->get();
        $Sliders = $Sliders -> toArray();
        //return response()->json('item'=>$Sliders);
        return response()->json($Sliders);
    }

      public function dataEditar(Request $request)
    {
        
        $url = explode("=", $request->url['hash']);
        dd($url[1]);
    }

    public function updateSlider(Request $request, $id)
    {
        
        //$upbanner = Slider::find($id);
        dd($request->all());
        //$banner->fill($request->all());
        //$banner->save();

        //$res = $this->getBanners();

        //return $res;


    }

}
