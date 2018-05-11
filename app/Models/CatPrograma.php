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

    public function componentes()
    {
        return $this->hasMany('App\Models\CatComponente', 'idPrograma', 'id');
    }
    public function organizaciones()
    {
        return $this->hasManyThrough(
      'App\Models\CatOrganizacion',//final
      'App\Models\CatComponente',//intermedia
      'idPrograma', // Foreign key on users table...
      'idComponente', // Foreign key on posts table...
      'id', // Local key on countries table...
      'id' // Local key on users table...
  );
    }
}
