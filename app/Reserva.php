<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public $timestamps = false;

    protected $fillable = ['cliente_id', 'fecha_reserva', 'fecha_inicio','fecha_fin', 'total_pagado','total','reservaestado_id','pagotipo_id', 'codigo_reserva','comentario', 'fraccion_importe'];
    
    public function habtiporeservas()
    {
    	return $this->hasMany('App\Habtiporeserva');
    }

    public function registro()
    {
    	return $this->hasOne('App\Registro');
    }

    public function cliente()
    {
    	return $this->belongsTo('App\Cliente');
    }

    public function usuario()
    {
    	return $this->belongsTo('App\Usuario');
    }
    public function pagotipo()
    {
        return $this->belongsTo('App\Pagotipo');
    }
    public function reservaestado()
    {
        return $this->belongsTo('App\Reservaestado');
    }

}
