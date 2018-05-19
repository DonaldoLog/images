<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatPrograma;
use App\Models\CatOrganizacion;
use App\Models\CatComponente;
use Yajra\DataTables\Datatables;
use DB;
use Alert;

class CatComponenteController extends Controller
{
    public function index(){

        return view('componente.index');
    }

    public function catCompontesDataTable(){
        $data =CatComponente::withCount('organizaciones')->with('programa')->get();
        if($data->isNotEmpty()){
            foreach ($data as $d) {
                $d->idPrograma=$d->programa->nombre;
            }
        }

        return Datatables::of($data)->make(true);
    }
    public function create(){
        $programas=CatPrograma::orderBy('nombre', 'asc')->pluck('nombre','id');
        return view('componente.create')->with('programas',$programas);
    }
    public function store(Request $request){
        //dd($request);
        $componente=new CatComponente();
        $componente->fill($request->all());
        if ($request->file('imagen')) {
                   $file = $request->file('imagen');
                   $name = 'imagen'.$request->nombre.'_'.time().'.'.$file->getClientOriginalExtension();
                   $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'componenteImagen'.DIRECTORY_SEPARATOR;
                   $file->move($path, $name);
                   $componente->imagen=$name;
        }
        $componente->idPrograma=$request->idPrograma;
        $componente->save();
        Alert::success('El componente ha sido guardado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('componente.index');
    }
    public function edit($id){
        $componente=CatComponente::find($id);
        $programas=CatPrograma::orderBy('nombre', 'asc')->pluck('nombre','id');

        return view('componente.edit')->with('componente',$componente)->with('programas',$programas);
    }
    public function update(Request $request,$id){
        $componente=CatComponente::find($id);
        $componente->fill($request->all());
        if ($request->file('imagen')) {
                   $file = $request->file('imagen');
                   $name = 'imagen'.$request->nombre.'_'.time().'.'.$file->getClientOriginalExtension();
                   $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'componenteImagen'.DIRECTORY_SEPARATOR;
                   $file->move($path, $name);
                   $componente->imagen=$name;
        }
        $componente->idPrograma=$request->idPrograma;
        $componente->save();
        Alert::success('El componente ha sido actualizado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('componente.index');
    }
    public function show(){
        return view('programa.index');
    }
    public function destroy($id){
        $componente = CatComponente::find($id);
        $organizaciones=$componente->organizaciones()->delete();
        $componente->delete();
        Alert::success('El programa ha sido eliminada con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('componente.index');
    }

}
