<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habitacion extends Model
{
    public $timestamps = false;

    protected $fillable = ['numero', 'estado_id', 'habtipo_id','hotel_id'];

    public function estado()
    {
    	return $this->belongsTo('App\Estado');
    }

    public function habtipo()
    {
        return $this->belongsTo('App\Habtipo');
    }

    public function habreservas()
    {
    	return $this->hasMany('App\Habreserva');
    }

    public function registros()
    {
    	return $this->hasMany('App\Registro');
    }
}