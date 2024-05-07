<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\FilePrerequisito;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddFilesPrerequisitosManager extends Component
{
    use WithFileUploads;

    public $folderId;
    public $documentFile;
    public $estabelecimentoGeral;

    public function mount($folderId)
    {
        $uuid = session('uuid');
        $this->estabelecimentoGeral = Company::where('uuid', $uuid)->first();
        $this->folderId = $folderId;
    }
    public function uploadDocument()
    {
        $this->validate([
            'documentFile' => 'required|file|max:10240', // 10MB máximo
        ]);

        $path = $this->documentFile->store('documents', 'public');

        // Criar um novo registro de documento associando ao folder
        FilePrerequisito::create([
            'name' => $this->documentFile->getClientOriginalName(),
            'avatar' => $path,
            'id_company' => $this->estabelecimentoGeral->id,
            'folder_id' => $this->folderId, // Usando o ID do folder aqui
        ]);

        $this->documentFile = null;
        session()->flash('message', 'Documento carregado com sucesso!');
    }
    public function render()
    {
        return view('livewire.add-files-prerequisitos-manager');
    }
}
