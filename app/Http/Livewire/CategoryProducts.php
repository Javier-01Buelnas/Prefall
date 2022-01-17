<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CategoryProducts extends Component
{
    public $categoria;
    public $productos = [];

    public function loadPost(){
        $this->productos = $this->categoria->productos()->where('estado', 2)->take(15)->get();
        $this->emit('glider', $this->categoria->id);
    }
    public function render()
    {
        return view('livewire.category-products');
    }
}
