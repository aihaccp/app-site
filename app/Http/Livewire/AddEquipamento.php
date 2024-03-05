<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Company;
use App\Models\Equipamento;
use Livewire\Component;

class AddEquipamento extends Component
{
    public $nome;
    public $tipo = [];
    public $temp_max;
    public $temp_min;
    public $id_area;

    public $id_empresa;

    protected $rules = [
        'nome' => 'required',
        'tipo' => 'required|array',
        'temp_max' => 'nullable|numeric|required_if:tipo,temperatura',
        'temp_min' => 'nullable|numeric|required_if:tipo,temperatura',
    ];
    public function mount($id_area)
    {
        $uuid = session('uuid');
        $this->id_empresa = Company::where('uuid', $uuid)->first();
        $id_are= Area::where('uuid', $id_area)->first();
        $this->id_area = $id_are->id;
    }

    public function addEquipamento()
    {
        $this->validate();

        Equipamento::create([
            'nome' => $this->nome,
            'tipo' => json_encode($this->tipo),
            'temp_max' => $this->temp_max,
            'temp_min' => $this->temp_min,
            'id_area' => $this->id_area,
            'id_empresa' => $this->id_empresa->id,
        ]);

        session()->flash('message', 'Equipamento adicionado com sucesso!');
        $this->reset(['nome', 'tipo', 'temp_max', 'temp_min']);
    }
    public function render()
    {
        return view('livewire.add-equipamento');
    }
}
