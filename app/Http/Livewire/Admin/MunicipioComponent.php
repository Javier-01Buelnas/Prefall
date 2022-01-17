<?php

namespace App\Http\Livewire\Admin;

use App\Models\Localidad;
use App\Models\Municipio;
use Livewire\Component;

class MunicipioComponent extends Component
{
    public $municipio, $localidades, $localidad;

    public $createForm = [
        'nombre' => null,
    ];
    public $editForm = [
        'open' => false,
        'nombre' => null,
    ];
    
    protected  $validationAttributes = [
        'createForm.nombre' => 'nombre',

        'editForm.nombre' => 'nombre',
    ];
    protected $listeners = ['delete'];


    public function mount(Municipio $municipio){
        $this->municipio = $municipio;
        $this->getLocalidades();
    }
    public function getLocalidades(){
        $this->localidades = Localidad::where('municipio_id', $this->municipio->id)->get();
    }
    public function open(){
        $this->editForm['open'] = false;
    }

    public function save(){
        $this->validate([
            'createForm.nombre' => 'required',
        ]);
        
        $this->municipio->localidades()->create($this->createForm);
        $this->reset('createForm');
        $this->getLocalidades();
        $this->emit('saved'); 
    }
    public function edit(Localidad $localidad){
        $this->localidad = $localidad;
        $this->editForm['open'] = true;
        $this->editForm['nombre'] = $localidad->nombre;
    }
    public function update(){
        $rules = [

            'editForm.nombre' => 'required',
        ];
        $this->validate($rules);

        $this->localidad->nombre = $this->editForm['nombre'];
        
        $this->localidad->save(); 

        $this->reset('editForm');
        $this->getLocalidades();
    }
    public function delete(Localidad $localidad){
        $localidad->delete();
        $this->getLocalidades();
    }
  
    public function render()
    {
        return view('livewire.admin.municipio-component')->layout('layouts.admin');
    }
}
