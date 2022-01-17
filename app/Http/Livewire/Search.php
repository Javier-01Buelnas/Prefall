<?php

namespace App\Http\Livewire;

use App\Models\producto;
use Livewire\Component;

class Search extends Component
{
    public $search, $open = false;

    public function updatedSearch($value){
        if ($value) {
            $this->open = true;
        } else {
            $this->open = false;
        }
        
    }
    public function render()
    {
        if ($this->search) {
            $productos = producto::where('nombre', 'LIKE', "%" . $this->search . "%")->where('estado', 2)->take(5)->get();
        } else {
            $productos = [];
        }
        

        return view('livewire.search', compact('productos'));
    }
}
