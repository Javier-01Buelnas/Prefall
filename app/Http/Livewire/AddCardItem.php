<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Storage;

class AddCardItem extends Component
{
    public $producto, $quantity;
    public $qty = 1;
    public $options = [];

    public function mount()
    {
        $this->quantity = qty_available($this->producto->id);
        $this->options['image'] = Storage::url($this->producto->images->first()->url);
        $this->options['brand'] = $this->producto->marcas;
    }

    public function decrement()
    {
        $this->qty = $this->qty - 1;
    }
    public function increment()
    {
        $this->qty = $this->qty + 1;
    }

    // carrito de compras
    public function addItem()
    {
        Cart::add([
            'id' => $this->producto->id,
            'name' => $this->producto->nombre,
            'qty' => $this->qty,
            'price' => $this->producto->precioVenta,
            'weight' => 550,
            'options' => $this->options
        ]);
        $this->quantity = qty_available($this->producto->id);
        $this->reset('qty');
        $this->emitTo('dropdown-cart', 'render');
    }
    public function render()
    {
        return view('livewire.add-card-item');
    }
}
