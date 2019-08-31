<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $fillable = [

		'name','sesion_id','estado','level_id'
	];
}
