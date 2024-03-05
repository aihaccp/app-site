<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Company;
use Livewire\Component;

class AddEspacoForm extends Component
{

    public $designacao;
    public $id_empresa;
    public function mount()
    {
        $uuid = session('uuid');
        $this->id_empresa = Company::where('uuid', $uuid)->first();
    }

    public function addEspaco()
    {
        $this->validate([
            'designacao' => 'required|string|max:255', // Validação do nome do espaço
        ]);

        Area::create([
            'designacao' => $this->designacao, // Adiciona o novo espaço ao banco de dados
            'id_empresa' => $this->id_empresa->id,
        ]);

        $this->reset('designacao'); // Reseta o campo após a inserção

        $this->emit('espacoAdded'); // Opcional: Emitir um evento para notificar o componente pai ou para fechar o modal
    }
    public function render()
    {
        return view('livewire.add-espaco-form');
    }
}
