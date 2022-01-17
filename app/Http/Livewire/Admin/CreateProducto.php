<?php

namespace App\Http\Livewire\Admin;

use App\Models\categoria;
use App\Models\marca;
use App\Models\producto;
use App\Models\subcategoria;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateProducto extends Component
{
    public $categorias, $subcategorias = [], $marcas = [];
    public $categoria_id = "", $subcategoria_id = "", $marca_id = "";
    public $clave, $nombre, $slug, $descripcion, $precioCompra, $precioVenta, $stock;

    protected $rules = [
        'clave' => 'required|unique:productos',
        'nombre' => 'required',
        'stock' => 'required',
        'slug' => 'required|unique:productos',
        'categoria_id' => 'required',
        'subcategoria_id' => 'required',
        'descripcion' => 'required',
        'marca_id' => 'required',
        'precioVenta' => 'required',
        'precioCompra' => 'required',
    ];

    public function updatedNombre($value){
        $this->slug = Str::slug($value);
    }
    public function updatedCategoriaId($value){
        $this->subcategorias = subcategoria::where('categoria_id', $value)->get();
        $this->marcas = marca::whereHas('categorias', function(Builder $query) use($value){
            $query->where('categoria_id', $value);
        })->get();
        $this->reset(['subcategoria_id', 'marca_id']);
    }    
    public function mount(){
        $this->categorias = categoria::all();
    }
    public function save(){
        $this->validate();
        
        $producto = new producto();

        $producto->clave = $this->clave;
        $producto->nombre = $this->nombre;
        $producto->slug = $this->slug;
        $producto->descripcion = $this->descripcion;
        $producto->precioCompra = $this->precioCompra;
        $producto->precioVenta = $this->precioVenta;
        $producto->stock = $this->stock;
        $producto->subcategoria_id = $this->subcategoria_id;
        $producto->marca_id = $this->marca_id;
        
        $producto->save();
        return redirect()->route('admin.productos.edit', $producto);
    }
    public function render()
    {
        return view('livewire.admin.create-producto')->layout('layouts.admin');
    }
}
