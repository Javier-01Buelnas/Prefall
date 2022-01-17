<?php

namespace App\Http\Livewire\Admin;

use App\Models\categoria;
use App\Models\subcategoria;
use Livewire\Component;
use Illuminate\Support\Str;

class ShowCategory extends Component
{
    public $categoria, $subcategorias, $subcategoria;

    public $createForm = [
        'nombre' => null,
        'slug' => null,
    ];
    public $editForm = [
        'open' => false,
        'nombre' => null,
        'slug' => null,
    ];
    protected $rules = [
        'createForm.nombre' => 'required|unique:subcategorias,nombre',
        'createForm.slug' => 'required',
    ];
    protected $validationAttributes = [
        'createForm.nombre' => 'nombre',
        'createForm.slug' => 'slug',

        'editForm.nombre' => 'nombre',
        'editForm.slug' => 'slug',
    ];
    public $listeners = ['delete'];
    
    public function mount(categoria $categoria)
    {
        $this->categoria = $categoria;
        $this->getSubcategorias();
    }
    public function updatedCreateFormNombre($value)
    {
        $this->createForm['slug'] = Str::slug($value);
    }
    public function updatedEditFormNombre($value)
    {
        $this->editForm['slug'] = Str::slug($value);
    }
    public function getSubcategorias()
    {
        $this->subcategorias = subcategoria::where('categoria_id', $this->categoria->id)->get();
    }
    public function open()
    {
        $this->editForm['open'] = false;
    }

    public function save()
    {
        $this->validate();
        $this->categoria->subcategorias()->create($this->createForm);
        $this->reset('createForm');
        $this->getSubcategorias();
    }
    public function edit(subcategoria $subcategoria)
    {
        $this->resetValidation();
        $this->subcategoria = $subcategoria;

        $this->editForm['open'] = true;
        $this->editForm['nombre'] = $subcategoria->nombre;
        $this->editForm['slug'] = $subcategoria->slug;
    }
    public function update()
    {
        $this->validate([
            'editForm.nombre' => 'required|unique:subcategorias,nombre,' . $this->subcategoria->id,
            'editForm.slug' => 'required',
        ]);
        
        $this->subcategoria->update($this->editForm);
        $this->getSubcategorias();
        $this->reset('editForm');
    }
    public function delete(subcategoria $subcategoria){
        $subcategoria->delete();
        $this->getSubcategorias();
    }
    public function render()
    {
        return view('livewire.admin.show-category')->layout('layouts.admin');
    }
}
