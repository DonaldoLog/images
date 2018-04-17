<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CatComponente extends Model
{
    public $table='cat_componente';

    public $fillable=[
        'id_programa',
        'nombre',
        'imagen'
    ];
}
