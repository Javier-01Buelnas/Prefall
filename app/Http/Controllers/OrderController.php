<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function index(){
        $orders = Order::query()->where('user_id', auth()->user()->id)->orderBy('id','desc');
        
        if (request('status')) {
            $orders->where('status', request('status'));
        }
        $orders = $orders->paginate(5);

        $pendiente = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $confirmado = Order::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $despachado = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $entregado = Order::where('status', 4)->where('user_id', auth()->user()->id)->count();
        $cancelado = Order::where('status', 5)->where('user_id', auth()->user()->id)->count();
        return view('orders.index', compact('orders', 'pendiente', 'confirmado', 'despachado', 'entregado', 'cancelado'));
    }
    
    public function show(Order $order){
        $this->authorize('author', $order);

        $items = json_decode($order->contenido);
        $envio = json_decode($order->envio);
        return view('orders.show', compact('order', 'items', 'envio'));
    }
    

    public function pay( Order $order, Request $request){
        $this->authorize('author', $order);

        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=APP_USR-4898684947028334-122404-b6c06513f60cfbeebfd8c916cb7ca374-1045735987");
        $response = json_decode($response);

        $status = $response->status;
    
        if ($status == 'approved') {
            $order->status = 2;
            $order->save();

        }
        return redirect()->route('orders.show', compact('order'));
    }
}
