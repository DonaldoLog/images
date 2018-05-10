<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CatPrograma extends Model
{
     use SoftDeletes;

    public $table='cat_programa';

    public $fillable=[
        'id',
        'nombre',
        'imagen'
    ];

    protected $dates = ['deleted_at'];

    public function componentes()
    {
    return $this->hasMany('App\Models\CatComponente','idPrograma','id');
    }
}
