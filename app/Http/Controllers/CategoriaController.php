<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoria;

class CategoriaController extends Controller
{
    public function show(categoria $categoria){
        return view('categorias.show', compact('categoria'));
    }
}
