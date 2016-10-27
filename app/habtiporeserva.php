<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habtiporeserva extends Model
{
	public $timestamps = false;

    protected $fillable = ['habtipo_id', 'reserva_id'];

    public function habtipo()
    {
    	return $this->belongsTo('App\Habtipo');
    }

    public function reserva()
    {
    	return $this->belongTo('App\Reserva');
    }
}
