<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CatComponente;
use Yajra\DataTables\Datatables;
use DB;

class AuditoriaController extends Controller
{
    public function index(){
        return view('auditoria.index');
    }

    public function catCompontesDataTable(){
        $componentes=CatComponente::orderBy('nombre','asc')->get();
        return Datatables::of($componentes)->make(true);
    }

    public function carpetas()
    {
        
    }
}
