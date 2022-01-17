<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\producto;
use Illuminate\Support\Facades\Storage;

class ShowProducts extends Component
{
    public $listeners = ['delete'];

    public function delete(Producto $producto){
        
        $images = $producto->images;

        foreach ($images as $image) {
            Storage::delete($image->url);
            $image->delete();
        }

        $producto->delete();

        return redirect()->route('admin.index');
    }
    public function render()
    {
      
        $productos = producto::all();
        return view('livewire.admin.show-products', compact('productos'))->layout('layouts.admin');
    }
}
