<?php
use App\Models\producto;
use Gloudemans\Shoppingcart\Facades\Cart;

function quantity($producto_id){
    $producto = producto::find($producto_id);
    $quantity = $producto->stock;

    return $quantity;
} 

function qty_added($producto_id){
    $cart = Cart::content();
    $item = $cart->where('id', $producto_id)->first();
    if ($item) {
        return $item->qty;
    }else{
        return 0;
    }
}

function qty_available($producto_id){
    return quantity($producto_id) - qty_added($producto_id);
}

function discount($item){
    $producto = producto::find($item->id);
    $qty_available = qty_available($item->id);
    
    $producto->stock = $qty_available;
    $producto->save();
}

function increase($item){
    $producto = producto::find($item->id);
    $quantity = quantity($item->id) + $item->qty;
    
    $producto->stock = $quantity;
    $producto->save();
}