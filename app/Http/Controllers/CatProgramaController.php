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
        return view('programa.index');
    }
    public function catProgramasDataTable(){
        $data =CatPrograma::withCount('componentes')->get();
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
    public function edit(){
        return view('programa.index');
    }
    public function update(){
        return view('programa.index');
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
