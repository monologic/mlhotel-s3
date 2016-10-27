<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'nombres', 'apellidos','fecha_nac','sexo','dni','estado_civil','pais','ciudad','celular','prof_ocup', 'email'
    ];

    public function reservas()
    {
    	return $this->hasMany('App\Reserva');
    }

    public function regclientes()
    {
    	return $this->hasMany('App\Regcliente');
    }
}
