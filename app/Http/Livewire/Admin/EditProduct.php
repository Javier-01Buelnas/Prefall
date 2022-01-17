<?php

namespace App\Http\Livewire\Admin;

use App\Models\categoria;
use App\Models\image;
use App\Models\subcategoria;
use App\Models\marca;
use Livewire\Component;
use App\Models\producto;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EditProduct extends Component
{
    public $producto, $categorias, $subcategorias, $marcas;
    public $categoria_id;


    protected $rules = [
        'clave' => 'required|unique:productos,clave',
        'producto.nombre' => 'required',
        'producto.stock' => 'required|numeric',
        'slug' => 'required|unique:productos,slug',
        'categoria_id' => 'required',
        'producto.subcategoria_id' => 'required',
        'producto.descripcion' => 'required|string',
        'producto.marca_id' => 'required',
        'producto.precioVenta' => 'required|numeric',
        'producto.precioCompra' => 'required|numeric',
    ];
    protected $listeners = [
        'refreshImage' ,
        'delete'
    ];

    public function mount(producto $producto){
        $this->producto = $producto;
        $this->clave = $this->producto->clave;
        $this->slug = $this->producto->slug;
        $this->categorias = categoria::all();

        $this->categoria_id = $producto->subcategoria->categoria->id;
        $this->subcategorias = subcategoria::where('categoria_id', $this->categoria_id)->get();
        $this->marcas = marca::whereHas('categorias', function(Builder $query){
            $query->where('categoria_id', $this->categoria_id);
        })->get();

    }
    public function updatedCategoriaId($value){
        $this->subcategorias = subcategoria::where('categoria_id', $value)->get();
        $this->marcas = marca::whereHas('categorias', function(Builder $query) use($value){
            $query->where('categoria_id', $value);
        })->get();
        $this->producto->subcategoria_id ="";
        $this->producto->marca_id ="";
    }  
    public function updatedProductoNombre($value){
        $this->slug = Str::slug($value);
    }
    public function save(){
        $rules = $this->rules;
        $rules['clave'] = 'required|unique:productos,clave,' . $this->producto->id;
        $rules['slug'] =  'required|unique:productos,slug,' . $this->producto->id;
        $this->validate($rules);

        $this->producto->clave = $this->clave;
        $this->producto->slug = $this->slug;

        $this->producto->save();
        $this->emit('saved');

        return redirect()->route('admin.index');

    }
    public function deleteImage(image $image){
        Storage::delete([$image->url]);
        $image->delete();
        $this->producto = $this->producto->fresh();

    }
    public function refreshImage(){
        $this->producto = $this->producto->fresh();
    }
    
    public function delete(){
        $images = $this->producto->images;

        foreach ($images as $image) {
            Storage::delete($image->url);
            $image->delete();
        }

        $this->producto->delete();

        return redirect()->route('admin.index');
    }

    public function render()
    {
        return view('livewire.admin.edit-product')->layout('layouts.admin');
    }
}
