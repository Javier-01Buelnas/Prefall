<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CreateUsuario extends Component
{
    public $open = true;
    public function render()
    {
        return view('livewire.admin.create-usuario');
    }
}
