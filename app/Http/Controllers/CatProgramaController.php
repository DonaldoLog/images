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
        return view('programa.index');
    }
    public function catProgramasDataTable(){
        $data=CatPrograma::orderBy('id','ASC')->get();
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
    public function destroy(){
        return view('programa.index');
    }

}
