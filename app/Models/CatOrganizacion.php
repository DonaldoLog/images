<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatOrganizacion extends Model
{
     use SoftDeletes;

    public $table='cat_organizacion';

    public $fillable=[
        'idComponente',
        'nombre'
    ];

    protected $dates = ['deleted_at'];

    public function componente()
    {
    return $this->belongsTo('App\Models\CatComponente','id','idComponente');
    }
}
