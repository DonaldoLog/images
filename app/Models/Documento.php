<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Documento extends Model
{
     use SoftDeletes;

    public $table='id_empresa';

    public $fillable=[
        'id_empresa',
        'archivo',
        'nombre'
    ];

    protected $dates = ['deleted_at'];
}
