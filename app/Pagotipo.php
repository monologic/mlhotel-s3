<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagotipo extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['pagotipo', 'activo'];

   	public function reservas()
    {
    	return $this->hasMany('App\Reserva');
    }
}
