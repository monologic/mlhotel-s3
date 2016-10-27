<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ico extends Model
{
    public $timestamps = false;
    
     protected $fillable = ['nombre', 'icono','descripcion'];
}
