<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
   /*  public function __construct()
    {
        $this->middleware('can:admin.productos.index')->only('index');
        $this->middleware('can:admin.productos.store')->only('store');
        $this->middleware('can:admin.productos.update')->only('update');
        $this->middleware('can:admin.productos.destroy')->only('destroy');
    } */
    
    public function files(Producto $producto, Request $request){

        $request->validate([
            'file' => 'required|image|max:2048'
        ]);

        $url = Storage::put('productos', $request->file('file'));
        $producto->images()->create([
            'url' => $url
        ]);
    }
}
