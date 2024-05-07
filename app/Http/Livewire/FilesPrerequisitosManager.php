<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\FolderPrerequisito;
use App\Models\FilePrerequisito;
use Livewire\Component;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class FilesPrerequisitosManager extends Component
{
    public $folders;
    public $folderId;
    public $documents = [];
    public $selectedFolderId;

    public function mount($slugFolder)
    {
        $uuid = Request::input('uuid'); // Captura o UUID da query string
        $company = Company::where('uuid', $uuid)->first(); // Busca a empresa pelo uuid

        if (!$company) {
            abort(404, "Empresa não encontrada.");
        }

        // Encontrar o folder pelo slug
        $folder = FolderPrerequisito::where('slug', $slugFolder)->first();
        $this->folderId = $folder->id;
        if (!$folder) {
            abort(404, "Folder não encontrado.");
        }

        // Filtrar documentos por folder e id_company
        $this->documents = FilePrerequisito::where('folder_id', $folder->id)
                            ->where('id_company', $company->id)
                            ->get();

        $this->selectedFolderId = $folder->id;
        $this->folders = [$folder]; // Coloca o folder num array para facilitar a manipulação na view
    }
    public function downloadDocument($documentId)
    {
        $document = FilePrerequisito::findOrFail($documentId);
        $filePath = $document->avatar;  // Assume que 'avatar' é o campo que contém o caminho do arquivo

        if (Storage::disk('public')->exists($filePath)) {
            return response()->download(Storage::disk('public')->path($filePath));
        } else {
            session()->flash('error', 'Arquivo não encontrado.');
            return redirect()->back();
        }
    }

     public function deleteDocument($documentId)
    {
        $document = FilePrerequisito::find($documentId);
        if ($document) {
            // Tentativa de excluir o arquivo físico
            if (Storage::disk('public')->exists($document->avatar)) {
                Storage::disk('public')->delete($document->avatar);
            }

            // Deletar a entrada do banco de dados após a exclusão do arquivo
            $document->delete();

            // Atualizar a lista de documentos após a exclusão
            $this->documents = FilePrerequisito::where('folder_id', $this->selectedFolderId)->get();
            session()->flash('message', 'Documento excluído com sucesso.');
        } else {
            session()->flash('error', 'Documento não encontrado.');
        }
    }
    public function render()
    {
        return view('livewire.files-prerequisitos-manager');
    }
}
