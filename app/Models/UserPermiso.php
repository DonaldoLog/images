<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermiso extends Model
{

   public $table='user_permiso';

   public $fillable=[
       'idUsuario',
       'idPrograma',
   ];

}
