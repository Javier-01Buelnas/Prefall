<?php

namespace App\Http\Livewire\Admin;

use App\Models\categoria;
use App\Models\marca;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class CreateCategory extends Component
{
    use WithFileUploads;

    public $marcas, $rand, $rand2, $categorias, $categoria;

    public $createForm = [
        'nombre' => null,
        'slug' => null,
        'icono' => null,
        'imagen' => null,
        'marcas' => [],
    ];
    public $editForm = [
        'open' => false,
        'nombre' => null,
        'slug' => null,
        'icono' => null,
        'imagen' => null,
        'marcas' => [],
    ];
    public $editImage;

    protected $rules = [
        'createForm.nombre' => 'required|unique:categorias,nombre',
        'createForm.slug' => 'required',
        'createForm.icono' => 'required',
        'createForm.imagen' => 'required|image|max:1024',
        'createForm.marcas' => 'required',
    ];
    protected $validationAttributes = [
        'createForm.nombre' => 'nombre',
        'createForm.slug' => 'slug',
        'createForm.icono' => 'icono',
        'createForm.imagen' => 'imagen',
        'createForm.marcas' => 'marcas',

        'editForm.nombre' => 'nombre',
        'editForm.slug' => 'slug',
        'editForm.icono' => 'icono',
        'editImage' => 'imagen',
        'editForm.marcas' => 'marcas',
    ];
    public $listeners = ['delete'];

    public function mount(){
        $this->getMarcas();
        $this->getCategorias();
        $this->rand = rand();
        $this->rand2 = rand(); 
    }
    public function updatedCreateFormNombre($value){
        $this->createForm['slug'] = Str::slug($value);
    }
    public function updatedEditFormNombre($value){
        $this->editForm['slug'] = Str::slug($value);
    }
    public function getMarcas(){
        $this->marcas = marca::all();
    }
    public function getCategorias(){
        $this->categorias = categoria::all();
        
    }
    public function open(){
        $this->editForm['open'] = false;
    }
    
    public function save(){
        $this->validate();
        $imagen = $this->createForm['imagen']->store('categorias');

        $categoria = categoria::create([
            'nombre' => $this->createForm['nombre'],
            'slug' => $this->createForm['slug'],
            'icono' => $this->createForm['icono'],
            'imagen' => $imagen
        ]);

        $categoria->marcas()->attach($this->createForm['marcas']);

        $this->rand = rand();
        $this->reset('createForm');
        $this->getCategorias();

        $this->emit('saved'); 

    }
    public function edit(categoria $categoria){
        $this->reset(['editImage']);
        $this->resetValidation();

        $this->categoria = $categoria;

        $this->editForm['open'] = true;
        $this->editForm['nombre'] = $categoria->nombre;
        $this->editForm['slug'] = $categoria->slug;
        $this->editForm['icono'] = $categoria->icono;
        $this->editForm['imagen'] = $categoria->imagen;
        $this->editForm['marcas'] = $categoria->marcas->pluck('id');
    }
    public function update(){
        $rules = [
            'editForm.nombre' => 'required|unique:categorias,nombre,' . $this->categoria->id,
            'editForm.slug' => 'required',
            'editForm.icono' => 'required',
            'editForm.marcas' => 'required',
        ];
        
        if ($this->editImage) {
            $rules['editImage'] = 'image|max:1024';
            
        }
        $this->validate($rules);

        if ($this->editImage) {
            Storage::delete($this->editForm['imagen']);
            $this->editForm['imagen'] = $this->editImage->store('categorias');
        }
        $this->categoria->update( $this->editForm);

        $this->categoria->marcas()->sync($this->editForm['marcas']);
        $this->rand2 = rand();
        $this->reset(['editForm', 'editImage']);
        $this->getCategorias();
    }
    public function delete(categoria $categoria){
        $categoria->delete();
        $this->getCategorias();
    }
    public function render()
    {
        return view('livewire.admin.create-category');
    }
}
