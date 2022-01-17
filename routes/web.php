<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\WebhooksController;
use App\Http\Livewire\ShoppingCart;
use App\Http\Livewire\CreateOrder;
use App\Http\Livewire\PaymentOrder;
use App\Models\Order;

Route::get('/', WelcomeController::class);
Route::get('search', SearchController::class)->name('search');
Route::get('categorias/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
Route::get('productos/{producto}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('cart', ShoppingCart::class)->name('cart');

Route::middleware(['auth'])->group(function () {
    Route::get('orders',[OrderController::class, 'index'])->name('orders.index');
    Route::get('orders/create', CreateOrder::class)->name('orders.create');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('payment/{order}', PaymentOrder::class)->name('orders.payment');
    Route::get('pay/{order}', [OrderController::class, 'pay'])->name('orders.pay');
    Route::post('webhooks', WebhooksController::class);
});

 