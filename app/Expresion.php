<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expresion extends Model



{

    protected $fillable = [

		'level_id','sesion_id','observation','fecha'
    ];
    

    public function categoria(){

        return $this->belongsTo(CategoryExpresion::class,'fonasa_id');
    }


    public function nivel(){

        return $this->belongsTo(Level::class,'level_id');
    }
}
