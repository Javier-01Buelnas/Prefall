<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\categoria;

class Navigation extends Component
{
    public function render()
    {
        $categorias = categoria::all();

        return view('livewire.navigation', compact('categorias') );
    }
}
