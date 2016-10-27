<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mainservice extends Model
{
	public $timestamps = false;
    protected $fillable = ['nombre', 'imagen', 'contenido'];
}