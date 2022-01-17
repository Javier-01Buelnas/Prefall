<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UsuariosIndex extends Component
{
    public $sort = 'id';
    public $direction = 'desc';
    use withPagination;
        protected $paginationTheme = "bootstrap";
        public $search;
        public function updattingsearch(){
        $this->resetPage();
    }
    public function render()
    {
        $users = User::where('name', 'Like','%'.$this->search.'%')
        ->orwhere('lastname', 'Like','%'.$this->search.'%')
        ->orwhere('company', 'Like','%'.$this->search.'%')
        ->orwhere('address', 'Like','%'.$this->search.'%')
        ->orwhere('email', 'Like','%'.$this->search.'%')
        ->orderBy($this->sort, $this->direction)
        ->paginate();
        return view('livewire.admin.usuarios-index', compact('users'));
    }
    public function order($sort){
        if ( $this->sort == $sort) {
            if ($this->direction == 'desc') {
                $this->direction = 'asc';
            } else {
                $this->direction = 'desc';
            }

        } else {
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }
    public function addNew(){
        $this->dispatchBrowserEvent('show-form');
    }
}
