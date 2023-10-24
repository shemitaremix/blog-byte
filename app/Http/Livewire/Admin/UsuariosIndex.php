<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UsuariosIndex extends Component
{

    use WithPagination;

    protected $paginationTheme = "bootstrap";
    
    public $buscar;

    public function updatingBuscar()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $usuarios = User::where('name', 'LIKE','%'.$this->buscar.'%')
                        ->where('id', '!=', auth()->user()->id)
                        ->orWhere('email', 'LIKE','%'.$this->buscar.'%')
                        ->where('id', '!=', auth()->user()->id)
                        ->paginate();

        return view('livewire.admin.usuarios-index', compact('usuarios'));
    }
}
