<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CatOrganizacion;
use App\Models\CatComponente;
use App\Models\CatPrograma;
use App\Models\Documento;
use Yajra\DataTables\Datatables;
use DB;
use App\Models\UserPermiso;

use Illuminate\Support\Facades\Auth;
use Alert;

class CatOrganizacionController extends Controller
{
    public function index($idPrograma,$idComponente){
        if (Auth::user()->nivel==3) {
            $componentes =UserPermiso::join('users','users.id','user_permiso.idUsuario')
            ->where('users.id',Auth::user()->id)
            ->pluck('user_permiso.idComponente')->toArray();
            if (in_array($idComponente,$componentes)) {
                $componente=CatComponente::find($idComponente);
                return view('organizacion.index')->with('idPrograma',$idPrograma)->with('idComponente',$idComponente)->with('componente',$componente);
            }else {
                return redirect()->route('programa.index');
            }
        }else {
            $componente=CatComponente::find($idComponente);
            return view('organizacion.index')->with('idPrograma',$idPrograma)->with('idComponente',$idComponente)->with('componente',$componente);
        }
    }

    public function catOrganizacionesDataTable($idComponente){
        if (Auth::user()->nivel==3) {
            $componentes =UserPermiso::join('users','users.id','user_permiso.idUsuario')
            ->where('users.id',Auth::user()->id)
            ->pluck('user_permiso.idComponente')->toArray();

            $data =DB::table('cat_organizacion')
                   ->join('cat_componente','cat_componente.id','=','cat_organizacion.idComponente')
                    ->select('cat_organizacion.id','cat_organizacion.nombre','cat_componente.nombre as componente')
                    ->whereNull('cat_organizacion.deleted_at')
                    ->whereNull('cat_componente.deleted_at')
                    ->where('cat_organizacion.idComponente',$idComponente)
                    ->whereIn('cat_componente.id',$componentes)
                   ->get();
        }else {
            $data =DB::table('cat_organizacion')
                   ->join('cat_componente','cat_componente.id','=','cat_organizacion.idComponente')
                    ->select('cat_organizacion.id','cat_organizacion.nombre','cat_componente.nombre as componente')
                    ->whereNull('cat_organizacion.deleted_at')
                    ->whereNull('cat_componente.deleted_at')
                    ->where('cat_organizacion.idComponente',$idComponente)
                   ->get();
        }

        return Datatables::of($data)->make(true);
    }
    public function create($idPrograma,$idComponente){
        $componente=CatComponente::where('id',$idComponente)->first();
        return view('organizacion.create')
        ->with('componente',$componente)
        ->with('idPrograma',$idPrograma)
        ->with('idComponente', $idComponente);
    }
    public function store(Request $request){
        //dd($request);
        $organizacion=new Catorganizacion();
        $organizacion->fill($request->all());
        $organizacion->idComponente=$request->idComponente;
        $organizacion->save();
        Alert::success('La organizacion ha sido guardado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('componente.index.programa',[$request->idPrograma,$request->idComponente]);
    }
    public function edit($idPrograma,$idComponente,$idOrganizacion){
        if (Auth::user()->nivel==3) {
            $componentes =UserPermiso::join('users','users.id','user_permiso.idUsuario')
            ->where('users.id',Auth::user()->id)
            ->pluck('user_permiso.idComponente')->toArray();
            $organizaciones = CatOrganizacion::join('cat_componente','cat_componente.id','cat_organizacion.idComponente')
            ->whereIn('cat_componente.id',$componentes)->pluck('cat_organizacion.id')->toArray();

            if (in_array($idOrganizacion,$organizaciones)) {
                $organizacion=Catorganizacion::find($idOrganizacion);
                $documentos=Documento::where('idEmpresa','=',$idOrganizacion)->get();
                $componente=CatComponente::where('id',$idComponente)->first();
                return view('organizacion.edit')
                ->with('organizacion',$organizacion)
                ->with('componente',$componente)
                ->with('documentos',$documentos)
                ->with('idPrograma',$idPrograma)
                ->with('idComponente',$idComponente);
            }else {
                return redirect()->route('programa.index');
            }
        }else {
            $organizacion=Catorganizacion::find($idOrganizacion);
            $documentos=Documento::where('idEmpresa','=',$idOrganizacion)->get();
            $componente=CatComponente::where('id',$idComponente)->first();
            return view('organizacion.edit')
            ->with('organizacion',$organizacion)
            ->with('componente',$componente)
            ->with('documentos',$documentos)
            ->with('idPrograma',$idPrograma)
            ->with('idComponente',$idComponente);
        }
    }
    public function update(Request $request,$id){
        $organizacion=Catorganizacion::find($id);
        $organizacion->fill($request->all());
        $organizacion->idComponente=$request->idComponente;
        $organizacion->save();
        Alert::success('La organizacion ha sido actualizado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('componente.index.programa',[$request->idPrograma,$request->idComponente]);
    }
    public function show(){
        return view('organizacion.index');
    }
    public function destroy($id){
        $organizacion = Catorganizacion::find($id);
        $organizacion->delete();
        Alert::success('La organizacion ha sido eliminada con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('organizacion.index');
    }
}
