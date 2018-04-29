<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatComponente extends Model
{
     use SoftDeletes;

    public $table='cat_componente';

    public $fillable=[
        'id_programa',
        'nombre',
        'imagen'
    ];

    protected $dates = ['deleted_at'];
}
