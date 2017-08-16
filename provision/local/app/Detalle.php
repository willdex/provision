<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $table='detalle';
    
     protected $fillable=['id_cuenta','id_asiento','debe','haber'];
     protected $dates = ['deleted_at'];
}
