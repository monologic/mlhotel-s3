<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Porcentaje extends Model
{
	public $timestamps = false;
	
    protected $fillable = [
        'porcentaje',
    ];
}
