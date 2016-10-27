<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class habtipo_serviciointerno extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['serviciointerno_id','habtipo_id','estado'];

    public function serviciointerno()
    {
    	return $this->belongsTo('App\Serviciointerno');
    }

    public function habtipo()
    {
    	return $this->belongsTo('App\Habtipos');
    }
}
