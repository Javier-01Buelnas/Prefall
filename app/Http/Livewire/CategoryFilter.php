<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\producto;
use Illuminate\Database\Eloquent\Builder;

class CategoryFilter extends Component
{
    use WithPagination;

    public $categoria, $subcategory, $brand;

    public $view = 'grid';

    protected $queryString = ['subcategory', 'brand'];

    public function limpiar(){
        $this->reset(['subcategory', 'brand', 'page']);
    }
    public function updatedSubcategory(){
        $this->resetPage();
    }
    public function updatedBrand(){
        $this->resetPage();
    }
    public function render()
    {
        $productosQuery = producto::query()->whereHas('subcategoria.categoria', function(Builder $query){
            $query->where('id', $this->categoria->id);
        });

        if ($this->subcategory) {
            $productosQuery = $productosQuery->whereHas('subcategoria', function(Builder $query){
                $query->where('slug', $this->subcategory);
            });
        } 
        if ($this->brand) {
            $productosQuery = $productosQuery->whereHas('marca', function(Builder $query){
                $query->where('nombre', $this->brand);
            });
        }
        
        $productos = $productosQuery->paginate(20);
        return view('livewire.category-filter', compact('productos'));
    }
}
