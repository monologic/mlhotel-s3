<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public $timestamps = false;

     protected $fillable = ['nombre', 'foto', 'descripcion', 'activo'];

    public function servicios()
    {
    	return $this->hasMany('App\Servicio');
    }
}
