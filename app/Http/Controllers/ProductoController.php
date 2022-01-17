<?php

namespace App\Http\Controllers;

use App\Models\categoria;
use Illuminate\Http\Request;
use App\Models\producto;

class ProductoController extends Controller
{
    public function index(){
        $productos = Producto::latest('id')->paginate(10);
        return view('productos.index', compact('productos'));
    }
    public function show(Producto $producto){
        $categoria = $producto->subcategoria->categoria->slug;
        return view('productos.show', compact('producto', 'categoria'));
    }
}
