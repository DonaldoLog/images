<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatOrganizacionController extends Controller
{
    public function index(){
        return view('organizacion.index');
    }
}
