<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\categoria;
use App\Models\marca;
use App\Models\Order;

class WelcomeController extends Controller
{
    public function __invoke()
    {

        if (auth()->user()) {
            $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
            if ($pendiente) {
                $mensaje = "$pendiente ordenes pendientes. <a class='font-bold' href='" . route('orders.index') . "?status=1'>Revisar Ahora</a>";

                session()->flash('flash.banner', $mensaje);
                session()->flash('flash.bannerStyle', 'danger');
            }
        }
        $marcas = marca::all();
        $categorias = categoria::all();
        return view('welcome', compact('categorias', 'marcas'));
    }
}
