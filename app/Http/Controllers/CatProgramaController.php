<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatPrograma;
use App\Models\CatOrganizacion;
use App\Models\CatComponente;
use App\Models\UserPermiso;
use Yajra\DataTables\Datatables;
use DB;
use Alert;
use Illuminate\Support\Facades\Auth;

class CatProgramaController extends Controller
{
    public function index(){
        if (Auth::user()->nivel==3) {
            $componentes =UserPermiso::join('users','users.id','user_permiso.idUsuario')
            ->where('users.id',Auth::user()->id)
            ->pluck('user_permiso.idComponente')->toArray();
            $data = CatPrograma::join('cat_componente','cat_componente.idPrograma','cat_programa.id')
            ->whereIn('cat_componente.id',$componentes)->withCount('componentes')->get();
            // $programas =CatPrograma::withCount('componentes')->orderBy('nombre')->get();
        }else {
            $data =CatPrograma::withCount('componentes')->orderBy('nombre')->get();
            // code...
        }
        // dd($componentes);
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
            $programa->imagen=$name;
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
