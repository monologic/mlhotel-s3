<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banco extends Model
{
    public $timestamps = false;
	
    protected $fillable = [
        'banco','cuenta','cci',
    ];
}
