<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serviciointerno extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['nombre','icono'];
    
    public function habtipo_serviciointernos()
    {
        return $this->hasMany('App\Habtipo_serviciointerno');
    }
}