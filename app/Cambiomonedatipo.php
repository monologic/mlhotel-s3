<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cambiomonedatipo extends Model
{
    protected $fillable = [
        'moneda', 'siglas', 'tipocambio',
    ];
}
