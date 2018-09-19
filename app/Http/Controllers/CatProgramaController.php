<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatPrograma;
use App\Models\CatOrganizacion;
use App\Models\CatComponente;
use Yajra\DataTables\Datatables;
use DB;
use Alert;

class CatProgramaController extends Controller
{
    public function index(){
        $data =CatPrograma::withCount('componentes')->orderBy('nombre')->get();
        return view('programa.index')->with('data',$data);
    }
    public function catProgramasDataTable(){
        $data =CatPrograma::withCount('componentes')->orderBy('nombre')->get();
        return Datatables::of($data)->make(true);
    }
    public function create(){
        return view('programa.create');
    }
    public function store(Request $request){
        // dd($request);
        $programa=new CatPrograma();
        $programa->fill($request->all());
        if ($request->file('imagen')) {
                   $file = $request->file('imagen');
                   $name = 'imagen'.$request->nombre.'_'.time().'.'.$file->getClientOriginalExtension();
                   $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'programasImagenes'.DIRECTORY_SEPARATOR;
                   $file->move($path, $name);
                   $programa->imagen=$name;
        }
        $programa->save();
        return redirect()->route('programa.index');
    }
    public function edit($idPrograma){
        $programa = CatPrograma::find($idPrograma);
        return view('programa.edit')
        ->with('programa',$programa);
    }
    public function update(Request $request,$idPrograma){
        $is = CatPrograma::where('nombre',$request->nombre)->where('id','!=',$idPrograma)->first();
        if ($is) {
            Alert::success('El nombre del programa ya existe.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
            return redirect()->back()->withInput();
        }
        $programa = CatPrograma::find($idPrograma);
        $programa->nombre = $request->nombre;
        $imagen = $programa->imagen;
        if ($request->file('imagen')) {
            $file = $request->file('imagen');
            $name = 'imagen'.$request->nombre.'_'.time().'.'.$file->getClientOriginalExtension();
            $path = public_path().DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'programasImagenes'.DIRECTORY_SEPARATOR;
            $file->move($path, $name);
            $programa->$imagen=$name;
        }
        $programa->save();
        Alert::success('El programa ha sido actualizado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('programa.index');
    }
    public function show(){
        return view('programa.index');
    }
    public function destroy($id){
        $programa = CatPrograma::find($id);
        $organizaciones=$programa->organizaciones()->get();
        CatOrganizacion::whereIn('id', $organizaciones)->delete();
        $programa->componentes()->delete();
        $programa->delete();
        Alert::success('El programa ha sido eliminada con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('programa.index');
    }

}
