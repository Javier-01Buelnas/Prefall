<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function index(){
        $orders = Order::query()->orderBy('id','desc');
        
        if (request('status')) {
            $orders->where('status', request('status'));
        }
        $orders = $orders->paginate(5);

        $pendiente = Order::where('status', 1)->count();
        $confirmado = Order::where('status', 2)->count();
        $despachado = Order::where('status', 3)->count();
        $entregado = Order::where('status', 4)->count();
        $cancelado = Order::where('status', 5)->count();

        return view('admin.ventas.index', compact('orders', 'pendiente', 'confirmado', 'despachado', 'entregado', 'cancelado'));
    }
    public function show(Order $order){
        return view('admin.ventas.show', compact('order'));
    }
}
