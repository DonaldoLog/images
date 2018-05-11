<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CatOrganizacion;
use App\Models\CatComponente;
use App\Models\CatPrograma;
use Yajra\DataTables\Datatables;
use DB;
use Alert;

class CatOrganizacionController extends Controller
{
    public function index(){
        return view('organizacion.index');
    }

    public function catOrganizacionesDataTable(){
        $data =DB::table('cat_organizacion')
               ->join('cat_componente','cat_componente.id','=','cat_organizacion.idComponente')
                ->select('cat_organizacion.id','cat_organizacion.nombre','cat_componente.nombre as componente')
                ->whereNull('cat_organizacion.deleted_at')
                ->whereNull('cat_componente.deleted_at')
                ->whereNull('cat_organizacion.deleted_at')
               ->get();
        //$data=CatComponente::orderBy('id','ASC')->get();
        return Datatables::of($data)->make(true);
    }
    public function create(){
        $componentes=CatComponente::all()->pluck('nombre','id');
        return view('organizacion.create')->with('componentes',$componentes);
    }
    public function store(Request $request){
        //dd($request);
        $organizacion=new Catorganizacion();
        $organizacion->fill($request->all());
        $organizacion->idComponente=$request->idComponente;
        $organizacion->save();
        Alert::success('La organizacion ha sido guardado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('organizacion.index');
    }
    public function edit($id){
        $organizacion=Catorganizacion::find($id);
        $componentes=CatComponente::orderBy('nombre', 'asc')
        ->whereNull('cat_organizacion.deleted_at')
        ->whereNull('cat_componente.deleted_at')
        ->pluck('nombre','id');

        return view('organizacion.edit')->with('organizacion',$organizacion)->with('componentes',$componentes);
    }
    public function update(Request $request,$id){
        $organizacion=Catorganizacion::find($id);
        $organizacion->fill($request->all());
        $organizacion->idComponente=$request->idComponente;
        $organizacion->save();
        Alert::success('La organizacion ha sido actualizado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('organizacion.index');
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
