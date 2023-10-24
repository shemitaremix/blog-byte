<?php

namespace App\Http\Livewire\Admin;

use App\Models\Etiquetas;
use Livewire\Component;
use Livewire\WithPagination;

class EtiquetasIndex extends Component
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
        $etiquetas = Etiquetas::where('status', 1)
            ->where('nombre', 'like', '%' . $this->buscar . '%')
            ->orWhere('status', 1)
            ->where('slug', 'like', '%' . $this->buscar . '%')
            ->paginate();
        return view('livewire.admin.etiquetas-index', compact('etiquetas'));
    }
}
