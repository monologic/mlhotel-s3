<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Habtipo extends Model
{
	public $timestamps = false;
	protected $fillable = ['nombre', 'descripcion', 'precio', 'foto','nropersonas','activo'];
	 
     public function habitacions()
    {
        return $this->hasMany('App\Habitacion');
    }
    public function habtipofotos()
    {
        return $this->hasMany('App\Habtipofoto');
    }
    public function habtiporeservas()
    {
        return $this->hasMany('App\Habtiporeserva');
        
    }
    public function habtipo_serviciointernos()
    {
        return $this->hasMany('App\habtipo_serviciointerno');
    }
}
