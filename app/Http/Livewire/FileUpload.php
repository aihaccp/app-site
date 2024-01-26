<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PlantaCompany;
use Illuminate\Support\Facades\Storage;

class FileUpload extends Component
{
    use WithFileUploads;

    public $linhas = [];
    public $establishmentUuid;
    public $tipo;
    public function mount($establishmentUuid, $tipo)
    {
        $this->establishmentUuid = Company::where('uuid', $establishmentUuid)->first()->id;
        $this->tipo = $tipo;
        $this->carregarDados();
    }
    private function carregarDados()
    {
        $this->linhas = [];
        $arquivos = PlantaCompany::where('id_empresa', $this->establishmentUuid)->where('tipo', $this->tipo)->get();
        foreach ($arquivos as $arquivo) {
            $this->linhas[] = [
                'id' => $arquivo->id,
                'nome' => $arquivo->name,
                'arquivo' => $arquivo->avatar,
                'tipo' => $this->tipo,
            ];
        }
    }

    public function adicionarLinha()
    {
        $this->linhas[] = ['nome' => '', 'arquivo' => null];
    }

    public function removerLinha($index)
    {
        $linha = $this->linhas[$index];

        if (isset($linha['id'])) {
            $registro = PlantaCompany::find($linha['id']);

            if ($registro) {
                // Remover o arquivo do storage
                if ($registro->avatar && Storage::exists($registro->avatar)) {
                    Storage::delete($registro->avatar);
                }

                // Remover o registro da base de dados
                $registro->delete();
            }
        }
        unset($this->linhas[$index]);
        $this->linhas = array_values($this->linhas);
        session()->flash('mensagem_sucesso', 'Ficheiro eliminado com sucesso');
    }

    public function salvar()
    {
        foreach ($this->linhas as $linha) {
            if (isset($linha['arquivo']) && $linha['arquivo'] instanceof \Illuminate\Http\UploadedFile) {
                // Processa e salva o novo upload
                $caminho = $linha['arquivo']->store('uploads', 'public');

                PlantaCompany::create([
                    'name' => $linha['nome'],
                    'avatar' => $caminho,
                    'id_empresa' => $this->establishmentUuid,
                    'tipo' => $this->tipo,
                ]);
            } elseif (isset($linha['id'])) {
                // Atualiza o registro existente se necessário
                $registro = PlantaCompany::find($linha['id']);
                if ($registro) {
                    $registro->update(['name' => $linha['nome']]);
                }
            }
        }
        $this->carregarDados();
        session()->flash('mensagem_sucesso', 'Ficheiros guardados com sucesso');
    }


    public function render()
    {
        return view('livewire.file-upload');
    }
}
