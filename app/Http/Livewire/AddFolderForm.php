<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Folder;
use Livewire\Component;

class AddFolderForm extends Component
{
    public $nomePasta;
    public $estabelecimentoGeral;

    public function addFolder()
    {
        // Validação (opcional)
        $this->validate([
            'nomePasta' => 'required|string|max:255',
        ]);
        $uuid = session('uuid');
        $this->estabelecimentoGeral = Company::where('uuid', $uuid)->first();


        // Adicionar na BD
        Folder::create([
            'name' => $this->nomePasta,
            'slug' => $this->nomePasta,
            'module_id' => 3,
            'id_company' => $this->estabelecimentoGeral->id,

        ]);

        // Feedback ao usuário ou redirecionamento (opcional)
        session()->flash('message', 'Pasta adicionada com sucesso!');

        // Reset do campo
        $this->reset('nomePasta');

        // Fechar modal ou outra ação (opcional)
    }
    public function render()
    {
        return view('livewire.add-folder-form');
    }
}
