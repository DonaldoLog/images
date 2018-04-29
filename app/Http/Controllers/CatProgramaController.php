<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatPrograma;
use Yajra\DataTables\Datatables;
use DB;
use Alert;

class CatProgramaController extends Controller
{
    public function index(){
        // $data = DB::table('cat_programa')
        //        ->join('cat_componente','cat_componente.idPrograma','=','cat_programa.id')
        //        ->select('cat_programa.id','cat_programa.nombre',DB::raw('ifnull(count(cat_componente.id),0) as total'))
        //        ->where('cat_programa.deleted_at','!=',null)
        //        ->groupBy('cat_programa.id')
        //        ->get();
        //  dd($data);
        return view('programa.index');
    }
    public function catProgramasDataTable(){
        $data = DB::table('cat_programa')
               ->join('cat_componente','cat_componente.idPrograma','=','cat_programa.id')
               ->select('cat_programa.id','cat_programa.nombre',DB::raw('ifnull(count(cat_componente.id),0) as total'))
               ->where('cat_programa.deleted_at','!=',null)
               ->groupBy('cat_programa.id')
               ->get();
        //$data=CatPrograma::orderBy('id','ASC')->get();
        return Datatables::of($data)->make(true);
    }
    public function create(){
        return view('programa.create');
    }
    public function store(Request $request){
        //dd($request);
        $programa=new CatPrograma();
        $programa->fill($request->all());
        $programa->save();
        return view('programa.index');
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
        $programa->delete();
        Alert::success('El programa ha sido eliminada con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('programa.index');
    }

}
