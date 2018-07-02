<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DocAuditoria extends Model
{
    use SoftDeletes;

   public $table='documento_auditoria';

   public $fillable=[
       'id',
       'idAuditoria',
       'documento',
       'nombre',
   ];

   public function componente()
   {
   return $this->belongsTo('App\Models\CatComponente','id','idComponente');
   }
}
