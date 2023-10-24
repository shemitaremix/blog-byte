<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Publicaciones;
use Livewire\WithPagination;

class PublicacionesIndex extends Component
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
        $publicaciones = Publicaciones::where('status', '!=', '3')
            ->where('user_id', auth()->user()->id)
            ->where('nombre', 'like', '%' . $this->buscar . '%')
            ->latest('id')
            ->paginate();
        return view('livewire.admin.publicaciones-index', compact('publicaciones'));
    }
}
