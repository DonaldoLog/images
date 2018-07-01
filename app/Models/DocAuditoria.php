<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DocAuditoria extends Model
{
    use SoftDeletes;

   public $table='auditoria';

   public $fillable=[
       'id',
       'idCatComponente',
       'nombre',
   ];

   public function componente()
   {
   return $this->belongsTo('App\Models\CatComponente','id','idComponente');
   }
}
