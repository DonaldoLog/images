<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatComponente;
use Yajra\DataTables\Datatables;
use App\Models\Auditoria;
use App\Models\DocAuditoria;
use App\Models\CatPrograma;
use ZipArchive;
use DB;
use Alert;
use App\Models\UserPermiso;
use Illuminate\Support\Facades\Auth;

class AuditoriaController extends Controller
{
    public function index(){
        return view('auditoria.index');
    }

    public function componetesDatatable(){
        if (Auth::user()->nivel==3) {
            $componentes =UserPermiso::join('users','users.id','user_permiso.idUsuario')
            ->where('users.id',Auth::user()->id)
            ->pluck('user_permiso.idComponente')->toArray();
            $data=CatComponente::orderBy('nombre','asc')->whereIn('id',$componentes)->get();
            return Datatables::of($data)->make(true);
        }else {
            $data=CatComponente::orderBy('nombre','asc')->get();
            return Datatables::of($data)->make(true);
        }

    }

    public function carpetas($idCatComponente)
    {
        if (Auth::user()->nivel==3) {
            $componentes =UserPermiso::join('users','users.id','user_permiso.idUsuario')
            ->where('users.id',Auth::user()->id)
            ->pluck('user_permiso.idComponente')->toArray();

            if (in_array($idCatComponente,$componentes)) {
                $carpetas=Auditoria::where('idCatComponente', $idCatComponente)->get();
                $componente=CatComponente::find($idCatComponente);
                return view('auditoria.componente.index')
                    ->with('carpetas',$carpetas)
                    ->with('componente',$componente);
                // code...
            }else {
                return redirect()->route('auditoria.index');
            }
        }else {
            $carpetas=Auditoria::where('idCatComponente', $idCatComponente)->get();
            $componente=CatComponente::find($idCatComponente);
            return view('auditoria.componente.index')
                ->with('carpetas',$carpetas)
                ->with('componente',$componente);
        }
    }

    public function createCarpeta(Request $request){
        $auditoria=Auditoria::where('nombre',$request->nombre)->first();
        if ($auditoria) {
            Alert::warning('El nombre de la carpeta ya existe.', 'Aviso')->persistent("Aceptar")->autoclose(2000);
            return redirect()->route('auditoria.componente',[$request->idCatComponente]);
            // code...
        }
        $carpeta=new Auditoria();
        $carpeta->idCatComponente=$request->idCatComponente;
        $carpeta->nombre=$request->nombre;
        $carpeta->save();
        Alert::success('La carpeta ha sido creada con exito.', 'Atención')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('auditoria.componente',[$request->idCatComponente]);
    }

    public function verCarpeta($idAuditoria){
        if (Auth::user()->nivel==3) {
            $componentes =UserPermiso::join('users','users.id','user_permiso.idUsuario')
            ->where('users.id',Auth::user()->id)
            ->pluck('user_permiso.idComponente')->toArray();
            $auditoria=Auditoria::findOrFail($idAuditoria);
            // dd($auditoria);
            $idComponente = CatComponente::where('id',$auditoria->idCatComponente)->value('id');
            // dd($idComponente,$componentes);
            if (in_array($idComponente,$componentes)) {
                $documentos=DocAuditoria::where('idAuditoria',$idAuditoria)->get();
                $componente=CatComponente::find($auditoria->idCatComponente);
                $programa=CatPrograma::find($componente->idPrograma);
                return  view('auditoria.componente.carpeta.index')
                    ->with('documentos',$documentos)
                    ->with('auditoria',$auditoria)
                    ->with('componente',$componente)
                    ->with('programa',$programa);
            }else {
                return redirect()->route('auditoria.index');
            }
        }else {
            $documentos=DocAuditoria::where('idAuditoria',$idAuditoria)->get();
            $auditoria=Auditoria::find($idAuditoria);
            $componente=CatComponente::find($auditoria->idCatComponente);
            $programa=CatPrograma::find($componente->idPrograma);
            // dd($programa)
            return  view('auditoria.componente.carpeta.index')
                ->with('documentos',$documentos)
                ->with('auditoria',$auditoria)
                ->with('componente',$componente)
                ->with('programa',$programa);
        }

    }

    public function updateCarpeta(Request $request){
        $auditoria=Auditoria::where('id','!=',$request->idAuditoria)->where('nombre',$request->nombre)->first();
        // dd($auditoria,$request);
        if ($auditoria) {
            Alert::warning('El nombre de la carpeta ya existe.', 'Aviso')->persistent("Aceptar")->autoclose(2000);
            return redirect()->route('auditoria.componente',[$request->idCatComponente]);
            // code...
        }
        $auditoria = Auditoria::find($request->idAuditoria);
        $auditoria->nombre=$request->nombre;
        $auditoria->save();
        // dd($auditoria,$request);
        Alert::success('La carpeta ha sido actualizado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('auditoria.componente',[$auditoria->idCatComponente]);
    }

    public function guardarArchivo(Request $request){
        $auditoria=Auditoria::find($request->idAuditoria);
        // dd($auditoria,$request);
        $nombreComponente=CatComponente::find($auditoria->idCatComponente)->select('nombre')->first();

        if($request->idFile!="" || $request->idFile!=null){
            // dd($request);
            $archivo=DocAuditoria::find($request->idFile);
            $archivo->nombre=$request->nombre;
            if ($request->file('file')) {
                    $file = $request->file('file');
                    $name = $nombreComponente->nombre."_".$auditoria->nombre."_".$request->nombre.'_'.time().'.'.$file->getClientOriginalExtension();
                    $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'auditoria'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR;
                    $file->move($path, $name);
                    $archivo->documento=$name;
                }else {
                    $archivo->documento=null;
                }
            $archivo->save();

        }else {
            $archivo= new DocAuditoria();
            $archivo->idAuditoria=$request->idAuditoria;
            $archivo->nombre=$request->nombre;
            if ($request->file('file')) {
                $file = $request->file('file');
                $name = $nombreComponente->nombre."_".$auditoria->nombre."_".$request->nombre.'_'.time().'.'.$file->getClientOriginalExtension();
                $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'auditoria'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR;
                $file->move($path, $name);
                $archivo->documento=$name;
            }else {
                $archivo->documento=null;
            }
            $archivo->save();
        }
        return redirect()->route('ver.auditoria.componente',[$request->idAuditoria]);
    }

    public function guardarArchivos(Request $request){
        $auditoria=Auditoria::find($request->idAuditoria);
        // dd($auditoria,$request);
        $nombreComponente=CatComponente::find($auditoria->idCatComponente)->select('nombre')->first();

        foreach ($request->file('file') as $key => $file) {
            $archivo= new DocAuditoria();
            $archivo->idAuditoria=$request->idAuditoria;
            $archivo->nombre = $file->getClientOriginalName();
            $name = $nombreComponente->nombre."_".$auditoria->nombre."_".$request->nombre.'_'.$key.'_'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'auditoria'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR;
            $file->move($path, $name);
            $archivo->documento=$name;
            $archivo->save();
        }

        return redirect()->route('ver.auditoria.componente',[$request->idAuditoria]);
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

    public function zipAll($idAuditoria)
    {
        // $files = array('readme.txt', 'test.html', 'image.gif');
        $files=DocAuditoria::Where('idAuditoria','=',$idAuditoria)->pluck('documento');
        $auditoria=CatComponente::join('auditoria','auditoria.idCatComponente','cat_componente.id')
            ->select('cat_componente.nombre as componente','auditoria.nombre as auditoria')
            ->where('auditoria.id',$idAuditoria)
            ->first();
            // dd($auditoria);
        $zipname = $auditoria->componente."_".$auditoria->auditoria."_".time().'.zip';
        $zip = new ZipArchive;
        // $zipname = time().".zip";
        $zip->open($zipname, ZipArchive::CREATE);
        foreach ($files as $file) {
            $path=public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'auditoria'.DIRECTORY_SEPARATOR.'archivos'.DIRECTORY_SEPARATOR.$file;
            $zip->addFromString(basename($file),  file_get_contents($path));
        }
        $zip->close();
        // dd($zip,$zipname);
        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename='.$zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);
    }

    public function destroyCarpeta($idAuditoria)
    {
        $carpeta=Auditoria::find($idAuditoria);
        $idCatComponente = $carpeta->idCatComponente;
        $carpeta->delete();


        Alert::success('La carpeta ha sido eliminada con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('auditoria.componente',[$idCatComponente]);
    }
}
