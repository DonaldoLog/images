<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatComponente;
use App\User;
use DB;
use App\Models\UserPermiso;
use Alert;
class AdminController extends Controller
{
    public function index(){
        $usuarios=User::leftjoin('user_permiso','user_permiso.idUsuario','users.id')
            ->join('cat_componente','cat_componente.id','user_permiso.idComponente')
            ->select(DB::raw('CONCAT(users.name," ",ifnull(users.primerAp," ")," ",ifnull(users.segundoAp," ")) as nombre'),
                    'users.email',
                    'users.id',
                    DB::raw('ifnull(group_concat(cat_componente.nombre)," ") as componentes')
                    )
            ->groupBy('users.id')
            ->get();


        // ('id',DB::raw('CONCAT(users.name," ",ifnull(users.primerAp," ")," ",ifnull(users.segundoAp," ")) as nombre'),'email')
        //     ->orderBy('name','asc')->get();
        // dump($usuarios);
        $componentes=CatComponente::orderBy('nombre','asc')->pluck('nombre','id');
        return view('admin.index')
            ->with('componentes',$componentes)
            ->with('usuarios',$usuarios);
    }

    public function store(Request $request){
        $user=new User($request->all());
        $user->password=bcrypt($request->password);
        $user->nivel = 3;
        $user->save();

        $user->assignRole('operador');

        foreach ($request->idComponente as $key => $idComponente) {
            $permiso=new UserPermiso();
            $permiso->idUsuario=$user->id;
            $permiso->idComponente=$idComponente;
            $permiso->save();
        }
        Alert::success('El usuario '.$user->name.' ha sido  creado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('admin.index');
    }

    public function edit($idUsuario){
        $usuario = User::find($idUsuario);

        $permisos = UserPermiso::where('idUsuario',$idUsuario)->select(DB::raw('group_concat(idComponente) as componentes'))->first();
        $data = array('usuario'=>$usuario,'permisos'=>$permisos->componentes);
        return response()->json($data);
    }

    public function update(Request $request,$idUsuario){
        $usuario = User::find($idUsuario);
        $usuario->name = $request->name;
        $usuario->primerAp = $request->primerAp;
        $usuario->segundoAp = $request->segundoAp;
        $usuario->email = $request->email;
        if ($request->newPassword!=null || $request->newPassword!='') {
            $usuario->password=bcrypt($request->newPassword);
        }
        $usuario->save();
        $permisos = UserPermiso::where('idUsuario',$idUsuario)->get();
        foreach ($permisos as $key => $permiso) {
            $permiso->delete();
        }

        foreach ($request->idComponente as $key => $idComponente) {
            $permiso=new UserPermiso();
            $permiso->idUsuario=$usuario->id;
            $permiso->idComponente=$idComponente;
            $permiso->save();
        }
        Alert::success('El usuario '.$usuario->name.' ha sido actualizado con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('admin.index');
    }

    public function delete($idUsuario){
        $user=User::find($idUsuario);
        $name=$user->name;
        $usercomponentes=UserPermiso::where('idUsuario',$idUsuario)->get();
        $user->delete();
        foreach ($usercomponentes as $usercomponente) {
            $usercomponente->delete();
        }
        Alert::success('El usuario ha sido eliminado '.$name.' con éxito.', 'Hecho')->persistent("Aceptar")->autoclose(2000);
        return redirect()->route('admin.index');
    }
}
