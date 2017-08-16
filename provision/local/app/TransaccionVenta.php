<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class TransaccionVenta extends Authenticatable 
                                    
{
    use   SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
      protected $table = 'transaccionventa';
    protected $fillable = [
        'idVenta', 'idBanco','idCuenta','monto','nroDocumento','tipo','fecha'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
 
    
}
