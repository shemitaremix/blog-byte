<?php

namespace App\Http\Livewire\Admin;

use App\Models\Categoria;
use Livewire\Component;
use Livewire\WithPagination;

class CategoriasIndex extends Component
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
        $categorias = Categoria::where('status', '!=', '2')
                ->where('nombre', 'like', '%' . $this->buscar . '%')
                ->latest('id')
                ->paginate();
        return view('livewire.admin.categorias-index', compact('categorias'));
    }
}
