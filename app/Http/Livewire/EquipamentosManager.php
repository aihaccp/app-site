<?php

namespace App\Http\Livewire;

use App\Models\Area;
use Livewire\Component;

class EquipamentosManager extends Component
{
    public $spaces;
    public $establishmentId;
    public function mount($establishmentId)
    {
        $this->establishmentId = $establishmentId;
        $this->loadSpaces();
    }
    public function loadSpaces()
    {
        $this->spaces = Area::where("id_empresa",$this->establishmentId)->get();
        // Carrega os espaços do estabelecimento

    }
    public function render()
    {
        return view('livewire.equipamentos-manager');
    }
}
