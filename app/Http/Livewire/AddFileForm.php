<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\File;
use App\Models\Folder;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddFileForm extends Component
{
    use WithFileUploads;

    public $selectedFolder = null;
    public $file;
    public $id_company;
    public $folders; // Opções de pastas

    public function mount()
    {
        $uuid = session('uuid');
        $id_company = Company::where('uuid', $uuid)->first()->id;
        $this->id_company= $id_company;
        $module = Module::where('slug', "documentos")->firstOrFail();
        $this->folders =  $module->folders()->where('id_company', $id_company)->get();
    }

    public function save()
    {
        $this->validate([
            'selectedFolder' => 'required',
            'file' => 'required|file|max:10240', // 10MB Max
        ]);

        $path = $this->file->store('files', 'public'); // Armazena o arquivo no disco 'public'

        // Cria uma nova instância de File e salva no banco de dados
        File::create([
            'folder_id' => $this->selectedFolder,
            'id_company' => $this->id_company,
            'name' => $this->file->getClientOriginalName(),
            'avatar' => $path,
            'type'=>0,
        ]);

        session()->flash('message', 'Arquivo adicionado com sucesso.');

        $this->reset(['selectedFolder', 'file']); // Reseta os campos do formulário
    }
    public function render()
    {
        return view('livewire.add-file-form');
    }
}
