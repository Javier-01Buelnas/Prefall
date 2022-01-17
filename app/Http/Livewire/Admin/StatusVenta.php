<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusVenta extends Component
{
    public $order, $status;

    public function mount(){
        $this->status = $this->order->status;
    }
    public function update(){
        $this->order->status = $this->status;
        $this->order->save();
    }
    public function render()
    {
        $items = json_decode($this->order->contenido);
        $envio = json_decode($this->order->envio);
        return view('livewire.admin.status-venta', compact('items', 'envio'));
    }
}
