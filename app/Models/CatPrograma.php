<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatPrograma extends Model
{
    public $table='cat_programa';

    public $fillable=[
        'nombre',
        'imagen'
    ];
}
