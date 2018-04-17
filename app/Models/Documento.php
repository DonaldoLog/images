<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    public $table='id_empresa';

    public $fillable=[
        'id_empresa',
        'archivo',
        'nombre'
    ];
}
