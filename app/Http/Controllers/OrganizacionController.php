<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatOrganizacion;
use App\Models\CatComponente;
use App\Models\CatPrograma;
use App\Models\Documento;
use DB;
use Alert;


class OrganizacionController extends Controller
{
    public function guardarArchivo(Request $request){
        $nombreEmpresa=CatOrganizacion::find($request->id)->select('nombre')->get()->first();

        $archivo= new Documento();
        $archivo->idEmpresa=$request->id;
        $archivo->nombre=$request->nombreArhivo;
        if ($request->file('file')) {
                $file = $request->file('file');
                $name = 'archivo'.$nombreEmpresa->nombre.'_'.time().'.'.$file->getClientOriginalExtension();
                $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR;
                $file->move($path, $name);
                $archivo->archivo=$name;
            }else {
                $archivo->archivo=null;
            }
        $archivo->save();

        return redirect()->route('organizacion.edit',$request->id);
    }
}
