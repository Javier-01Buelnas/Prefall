<?php

namespace App\Http\Livewire\Admin;

use App\Models\Estado;
use Livewire\Component;

class EstadoComponent extends Component
{
    public $estados, $estado;

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


    public function mount()
    {
        $this->getEstados();
    }
    public function getEstados()
    {
        $this->estados = Estado::all();
    }
    public function open()
    {
        $this->editForm['open'] = false;
    }

    public function save()
    {
        $this->validate([
            'createForm.nombre' => 'required|unique:categorias,nombre',
        ]);
        Estado::create($this->createForm);
        $this->reset('createForm');
        $this->getEstados();
        $this->emit('saved');
    }
    public function edit(Estado $estado)
    {
        $this->estado = $estado;
        $this->editForm['open'] = true;
        $this->editForm['nombre'] = $estado->nombre;
    }
    public function update()
    {
        $rules = [

            'editForm.nombre' => 'required|unique:estados,nombre,' . $this->estado->id,
        ];
        $this->validate($rules);
        $this->estado->nombre = $this->editForm['nombre'];
        $this->estado->save();

        $this->reset('editForm');
        $this->getEstados();
    }
    public function delete(Estado $estado)
    {
        $estado->delete();
        $this->getEstados();
    }
    public function render()
    {
        return view('livewire.admin.estado-component')->layout('layouts.admin');
    }
}
