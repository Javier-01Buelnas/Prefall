<?php

namespace App\Http\Livewire\Admin;

use App\Models\marca;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class BransComponent extends Component
{
    use WithFileUploads;

    public $marcas, $marca, $rand, $rand2;

    public $createForm = [
        'nombre' => null,
        'imagen' => null,
    ];
    public $editForm = [
        'open' => false,
        'nombre' => null,
        'imagen' => null,
    ];

    public $editImage;

    public $rules = [
        'createForm.nombre' => 'required|unique:marcas,nombre',
        'createForm.imagen' => 'required|image|max:1024',
    ];
    protected $validationAttributes = [
        'createForm.nombre' => 'nombre',
        'createForm.imagen' => 'imagen',

        'editForm.nombre' => 'nombre',
        'editImage' => 'imagen',
    ];
    public $listeners = ['delete'];

    public function mount(){
        $this->getMarcas();
        $this->rand = rand();
        $this->rand2 = rand();
    }
    public function getMarcas(){
        $this->marcas = marca::all();
    }
    public function open(){
        $this->editForm['open'] = false;
    }

    public function save(){
        $this->validate();
        $imagen = $this->createForm['imagen']->store('marcas');

        marca::create([
            'nombre' => $this->createForm['nombre'],
            'imagen' => $imagen
        ]);

        $this->rand = rand();
        $this->reset('createForm');
        $this->getMarcas();


        $this->emit('saved'); 

    }
    public function edit(marca $marca){
        $this->reset(['editImage']);
        $this->resetValidation();

        $this->marca = $marca;

        $this->editForm['open'] = true;
        $this->editForm['nombre'] = $marca->nombre;
        $this->editForm['imagen'] = $marca->imagen;
    }
    public function update(){
        $rules = [
            'editForm.nombre' => 'required|unique:marcas,nombre,' . $this->marca->id,
        ];
        
        if ($this->editImage) {
            $rules['editImage'] = 'image|max:1024';
            
        }
        $this->validate($rules);

        if ($this->editImage) {
            Storage::delete($this->editForm['imagen']);
            $this->editForm['imagen'] = $this->editImage->store('marcas');
        }
        $this->marca->update( $this->editForm);
        $this->rand2 = rand();
        $this->reset(['editForm', 'editImage']);
        $this->getMarcas();
    }
    public function delete(marca $marca){
        $marca->delete();
        $this->getMarcas();
    } 
    public function render()
    {
        return view('livewire.admin.brans-component')->layout('layouts.admin');
    }
}
