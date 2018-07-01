<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatComponente;
use Yajra\DataTables\Datatables;
use App\Models\Auditoria;
use App\Models\DocAuditoria;
use DB;

class AuditoriaController extends Controller
{
    public function index(){
        return view('auditoria.index');
    }

    public function componetesDatatable(){
        $data=CatComponente::orderBy('nombre','asc')->get();
        return Datatables::of($data)->make(true);
    }

    public function carpetas($idCatComponente)
    {
        $carpetas=Auditoria::where('idCatComponente', $idCatComponente)->get();
        $componente=CatComponente::find($idCatComponente);
        return view('auditoria.componente.index')
            ->with('carpetas',$carpetas)
            ->with('componente',$componente);
    }

    public function createCarpeta(Request $request){
        $carpeta=new Auditoria();
        $carpeta->idCatComponente=$request->idCatComponente;
        $carpeta->nombre=$request->nombre;
        $carpeta->save();
        return redirect()->route('auditoria.componente',[$request->idCatComponente]);
    }

    public function verCarpeta($idAuditoria){
        $documentos=DocAuditoria::where('idAuditoria',$idAuditoria)->get();
        $auditoria=Auditoria::find($idAuditoria);
        return  view('auditoria.componente.carpeta.index')
            ->with('documentos',$documentos)
            ->with('auditoria',$auditoria);
    }

    public function guardarArchivo(Request $request){
        $auditoria=Auditoria::find($request->idAuditora);
        $nombreComponente=CatOrganizacion::find($auditoria->idCatComponente)->select('nombre')->get()->first();

        if($request->idFile!="" || $request->idFile!=null){
            // dd($request);
            $archivo=DocAuditoria::find($request->idFile);
            $archivo->nombre=$request->nombreArhivo;
            if ($request->file('file')) {
                    $file = $request->file('file');
                    $name = $nombreComponente->nombre."_".$request->nombreArhivo.'_'.time().'.'.$file->getClientOriginalExtension();
                    $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'auditoria'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR;
                    $file->move($path, $name);
                    $archivo->archivo=$name;
                }else {
                    $archivo->archivo=null;
                }
            $archivo->save();

        }else {
            $archivo= new DocAuditoria();
            $archivo->idEmpresa=$request->idEmpresa;
            $archivo->nombre=$request->nombreArhivo;
            if ($request->file('file')) {
                $file = $request->file('file');
                $name = $nombreComponente->nombre."_".$request->nombreArhivo.'_'.time().'.'.$file->getClientOriginalExtension();
                $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'auditoria'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR;
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
        $file= DocAuditoria::find($id);
        return [$file];
    }

    public function docDestroy($id){
        $file=DocAuditoria::find($id);
        $file->delete();
        return ['success'=>true];
    }

    public function zipAll($idCatComponente)
    {
        // $files = array('readme.txt', 'test.html', 'image.gif');
        $files=DocAuditoria::Where('idAuditora','=',$idAuditoria)->pluck('archivo');
        $componente=CatComponente::join('auditoria','auditoria.idCatComponente','cat_componente.id')
            ->select('cat_componente.*')
            ->get();
        $zipname = $componente->nombre.'.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $ruta=public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'auditoria'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR.$file;
            $zip->addFile($ruta);
            dump($ruta);
        }
        $zip->close();
        dd($zip,$zipname);
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=filename.zip');
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }
}
