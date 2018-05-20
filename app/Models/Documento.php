<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
     use SoftDeletes;

    public $table='documento';

    public $fillable=[
        'idEmpresa',
        'archivo',
        'nombre'
    ];

    protected $dates = ['deleted_at'];
}
