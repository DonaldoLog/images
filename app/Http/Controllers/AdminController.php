<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\catPrograma;
use App\User;
use DB;
use App\Models\UserPermiso;
class AdminController extends Controller
{
    public function index(){
        $usuarios=User::leftjoin('user_permiso','user_permiso.idUsuario','users.id')
            ->join('cat_programa','cat_programa.id','user_permiso.idPrograma')
            ->select(DB::raw('CONCAT(users.name," ",ifnull(users.primerAp," ")," ",ifnull(users.segundoAp," ")) as nombre'),
                    'users.email',
                    'users.id',
                    DB::raw('ifnull(group_concat(cat_programa.nombre)," ") as programas')
                    )
            ->groupBy('users.id')
            ->get();


        // ('id',DB::raw('CONCAT(users.name," ",ifnull(users.primerAp," ")," ",ifnull(users.segundoAp," ")) as nombre'),'email')
        //     ->orderBy('name','asc')->get();
        // dump($usuarios);
        $programas=catPrograma::orderBy('nombre','asc')->pluck('nombre','id');
        return view('admin.index')
            ->with('programas',$programas)
            ->with('usuarios',$usuarios);
    }

    public function store(Request $request){
        $user=new User($request->all());
        $user->password=bcrypt($request->password);
        $user->save();

        foreach ($request->idProgramas as $key => $idPrograma) {
            $permiso=new UserPermiso();
            $permiso->idUsuario=$user->id;
            $permiso->idPrograma=$idPrograma;
            $permiso->save();
        }

        return redirect()->route('admin.index');
    }

    public function edit($idUsuario){
        $usuario=User::leftjoin('user_permiso','user_permiso.idUsuario','users.id')
            ->join('cat_programa','cat_programa.id','user_permiso.idPrograma')
            ->select(DB::raw('CONCAT(users.name," ",ifnull(users.primerAp," ")," ",ifnull(users.segundoAp," ")) as nombre'),
                    'users.email',
                    'users.id',
                    DB::raw('ifnull(group_concat(cat_programa.nombre)," ") as programas')
                    )
            ->where('users.id',$idUsuario)
            ->groupBy('users.id')
            ->get();
        return [$usuario];
    }

    public function update(Request $request,$idUsuario){

        return redirect()->route('admin.index');
    }

    public function delete($idUsuario){
        $user=User::find($idUsuario);
        $userProgramas=UserPermiso::where('idUsuario',$idUsuario)->get();
        $user->delete();
        foreach ($userProgramas as $userPrograma) {
            $userPrograma->delete();
        }
        return redirect()->route('admin.index');
    }
}
