<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatComponenteController extends Controller
{
    public function index(){
        return view('componente.index');
    }
}
