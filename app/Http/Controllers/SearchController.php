<?php

namespace App\Http\Controllers;

use App\Models\producto;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    public function __invoke(Request $request)
    {
        $nombre = $request->nombre;
        $productos = producto::where('nombre', 'LIKE', "%" . $nombre . "%")->where('estado', 2)->paginate(10);
       
        return view('search', compact('productos'));
    }
}
