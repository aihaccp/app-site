<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EstabelecimentoSelector extends Component
{
    public $uuid;

    public $estabelecimentos;
    public $estabelecimentoSelecionado;
    public $estabelecimentoSelecionadoNome = 'Selecione um estabelecimento';

    public function mount()
    {

        $this->loadEstb();
        $this->uuid = request()->query('uuid');

        if ($this->uuid) {
            $estabelecimento = $this->estabelecimentos->firstWhere('uuid', $this->uuid);

            if ($estabelecimento) {
                $this->estabelecimentoSelecionadoNome = $estabelecimento->name;
            }
        }

    }
    public function loadEstb()
    {
        $organization = Auth::user()->id_company;
        $estabelecimentos = Company::where('organition_id', $organization)->get();

        $contador = 1;
        foreach ($estabelecimentos as $estabelecimento) {
            if (is_null($estabelecimento->name)) {
                $estabelecimento->name = 'Estabelecimento ' . $contador;
            }
            $contador++;
        }

        $this->estabelecimentos = $estabelecimentos;
    }
    public function getQueryString()
    {
        return ['uuid' => ['uuid' => '']];
    }

    public function selectEstabelecimento($uuid, $nome)
    {
        $this->estabelecimentoSelecionado = $uuid;
        $this->estabelecimentoSelecionadoNome = $nome;
        $this->uuid = $uuid;
        session()->forget('uuid');
        session(['uuid' => $uuid]);
        $this->loadEstb();
    }

    public function render()
    {
        return view('livewire.estabelecimento-selector');
    }
}
