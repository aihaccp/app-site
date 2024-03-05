<?php

namespace App\Http\Livewire;

use App\Models\Equipamento;
use Livewire\Component;

class EditEquipamento extends Component
{
    public Equipamento $equipamento;
    public $nome;
    public $tipo = [];
    public $temp_max;
    public $temp_min;

    // Supondo que exista um campo 'tipo' para distinguir os equipamentos

    public function mount(Equipamento $equipamento)
    {
        $this->equipamento = $equipamento;
        $this->nome = $equipamento->nome;
        $this->tipo = json_decode($equipamento->tipo, true);
        $this->temp_max = $equipamento->temp_max ?? '';
        $this->temp_min = $equipamento->temp_min ?? '';
    }

    public function save()
    {
        $this->validate([
            'nome' => 'required',
            'tipo' => 'required|array',
            'temp_max' => 'required_if:tipo,temperatura|nullable|numeric',
            'temp_min' => 'required_if:tipo,temperatura|nullable|numeric',
        ]);

        $this->equipamento->update([
            'nome' => $this->nome,
            'tipo' => json_encode($this->tipo),
            'temp_max' => in_array('temperatura', $this->tipo) ? $this->temp_max : null,
            'temp_min' => in_array('temperatura', $this->tipo) ? $this->temp_min : null,
        ]);
        session()->flash('message', 'Equipamento atualizado com sucesso.');
    }

    public function render()
    {
        return view('livewire.edit-equipamento');
    }
}
