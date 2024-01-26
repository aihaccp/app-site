<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class GrupoTrabalho extends Component {
    public $estabelecimento;
    public $grupos = [];
    public function mount($estabelecimentoUui) {
        $this->estabelecimento = Company::where('uuid', $estabelecimentoUui)->first()->id;
        $this->companie = $this->estabelecimento;
        $this->grupos = \App\Models\GrupoTrabalho::where('id_empresa', $this->estabelecimento)->get()->toArray();
    }


    public function adicionarGrupo() {
        $this->grupos[] = ['nome_cargo' => '', 'name_resp' => ''];
    }

    public function removerGrupo($index) {
        $grupo = $this->grupos[$index];

        // Se o grupo tiver um ID, remova-o do banco de dados
        if(isset($grupo['id'])) {
            \App\Models\GrupoTrabalho::find($grupo['id'])->delete();
        }
        // Remover o grupo do array
        unset($this->grupos[$index]);
        $this->grupos = array_values($this->grupos);
    }

    public function salvar() {

        foreach($this->grupos as $grupo) {
            if(isset($grupo['id']) && $grupo['id']) {
                // Atualizar o registro existente
                $grupotrabalho = \App\Models\GrupoTrabalho::find($grupo['id']);
            } else {
                // Criar um novo registro
                $grupotrabalho = new \App\Models\GrupoTrabalho;
            }
            $grupotrabalho->nome_cargo = $grupo['nome_cargo'];
            $grupotrabalho->name_resp = $grupo['name_resp'];
            $grupotrabalho->name_outsourcing = $grupo['name_outsourcing'];
            $grupotrabalho->id_empresa = $this->estabelecimento;
            $grupotrabalho->save();
        }

        // Atualizar a lista após salvar
        $this->grupos = \App\Models\GrupoTrabalho::where('id_empresa', $this->estabelecimento)
            ->get()->toArray();
        session()->flash('mensagem_sucesso', 'Guardado com sucesso');
    }

    public function render() {
        return view('livewire.grupo-trabalho');
    }
}
