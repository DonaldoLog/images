<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CatOrganizacion extends Model
{
    public $table='cat_organizacion';

    public $fillable=[
        'id_componente',
        'nombre'
    ];
}
