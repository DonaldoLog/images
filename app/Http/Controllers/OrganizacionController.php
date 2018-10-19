<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatOrganizacion;
use App\Models\CatComponente;
use App\Models\CatPrograma;
use App\Models\Documento;
use DB;
use Alert;
use ZipArchive;


class OrganizacionController extends Controller
{
    public function guardarArchivo(Request $request){
        $nombreEmpresa=CatOrganizacion::find($request->idEmpresa)->select('nombre')->get()->first();

        if($request->idFile!="" || $request->idFile!=null){
            // dd($request);
            $archivo=Documento::find($request->idFile);
            $archivo->nombre=$request->nombreArhivo;
            if ($request->file('file')) {
                    $file = $request->file('file');
                    $name = $nombreEmpresa->nombre."_".$request->nombreArhivo.'_'.time().'.'.$file->getClientOriginalExtension();
                    $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR;
                    $file->move($path, $name);
                    $archivo->archivo=$name;
                }else {
                    $archivo->archivo=null;
                }
            $archivo->save();

        }else {
            $archivo= new Documento();
            $archivo->idEmpresa=$request->idEmpresa;
            $archivo->nombre=$request->nombreArhivo;
            if ($request->file('file')) {
                $file = $request->file('file');
                $name = $nombreEmpresa->nombre."_".$request->nombreArhivo.'_'.time().'.'.$file->getClientOriginalExtension();
                $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR;
                $file->move($path, $name);
                $archivo->archivo=$name;
            }else {
                $archivo->archivo=null;
            }
            $archivo->save();
        }
        return redirect()->route('organizacion.edit',[$request->idPrograma,$request->idComponente,$request->idEmpresa]);

    }

    public function getArchivo($id){
        $file= Documento::find($id);
        return [$file];
    }

    public function docDestroy($id){
        $file=Documento::find($id);
        $file->delete();
        return ['success'=>true];
    }

    public function zipAll($idOrganizacion)
    {
        // $files = array('readme.txt', 'test.html', 'image.gif');
        $files=Documento::Where('idEmpresa','=',$idOrganizacion)->pluck('archivo');
        $organizacion=CatOrganizacion::find($idOrganizacion);
        $zip = new ZipArchive;
        $zip_name = time().".zip";
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $ruta=public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR.$file;
            $zip->addFile($ruta);
            // dump($ruta);
        }
        $zip->close();
        // dd($zip,$zipname);
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }

}
