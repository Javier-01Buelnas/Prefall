<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class StatusProduct extends Component
{
    public $producto, $status;

    public function mount(){
        $this->status = $this->producto->estado;
    }
    public function save(){
        $this->producto->estado = $this->status;
        $this->producto->save();
        $this->emit('saved');
    }

    public function render()
    {
        
        return view('livewire.admin.status-product');
    }
}
