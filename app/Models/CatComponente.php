<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatComponente extends Model
{
     use SoftDeletes;

    public $table='cat_componente';

    public $fillable=[
        'id',
        'idPrograma',
        'nombre',
        'imagen'
    ];

    protected $dates = ['deleted_at'];

    public function organizaciones()
    {
    return $this->hasMany('App\Models\CatOrganizacion','idComponente','id');
    }

    public function programa()
    {
    return $this->belongsTo('App\Models\CatPrograma','id','idPrograma');
    }
    
}
