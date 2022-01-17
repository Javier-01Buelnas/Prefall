<?php

namespace App\Http\Livewire\Admin;

use App\Models\Estado;
use App\Models\Municipio;
use Livewire\Component;

class ShowEstado extends Component
{
    public $estado, $municipios, $municipio;

    public $createForm = [
        'nombre' => null,
        'costo' => null,
    ];
    public $editForm = [
        'open' => false,
        'nombre' => null,
        'costo' => null,
    ];
    
    protected  $validationAttributes = [
        'createForm.nombre' => 'nombre',
        'createForm.costo' => 'costo',

        'editForm.nombre' => 'nombre',
        'editForm.costo' => 'costo',
    ];
    protected $listeners = ['delete'];


    public function mount(Estado $estado){
        $this->estado = $estado;
        $this->getMunicipios();
    }
    public function getMunicipios(){
        $this->municipios = Municipio::where('estado_id', $this->estado->id)->get();
    }
    public function open(){
        $this->editForm['open'] = false;
    }

    public function save(){
        $this->validate([
            'createForm.nombre' => 'required|unique:municipios,nombre',
            'createForm.costo' => 'required|numeric|min:1|max:100',
        ]);
        
        $this->estado->municipios()->create($this->createForm);
        $this->reset('createForm');
        $this->getMunicipios();
        $this->emit('saved'); 
    }
    public function edit(Municipio $municipio){
        $this->municipio = $municipio;
        $this->editForm['open'] = true;
        $this->editForm['nombre'] = $municipio->nombre;
        $this->editForm['costo'] = $municipio->costo;
    }
    public function update(){
        $rules = [

            'editForm.nombre' => 'required',
            'editForm.costo' => 'required|numeric|min:1|max:100',
        ];
        $this->validate($rules);

        $this->municipio->nombre = $this->editForm['nombre'];
        $this->municipio->costo = $this->editForm['costo'];
        $this->municipio->save(); 

        $this->reset('editForm');
        $this->getMunicipios();
    }
    public function delete(Municipio $municipio){
        $municipio->delete();
        $this->getMunicipios();
    }
  
    public function render()
    {
        return view('livewire.admin.show-estado')->layout('layouts.admin');
    }
}
