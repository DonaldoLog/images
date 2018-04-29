<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatPrograma extends Model
{
     use SoftDeletes;

    public $table='cat_programa';

    public $fillable=[
        'nombre',
        'imagen'
    ];

    protected $dates = ['deleted_at'];
}
