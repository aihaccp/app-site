<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class InfoEstabelecimento extends Component
{
    public $estabelecimentoUui;
    public $estabelecimento;
    public $companie;
    protected $rules = [
        'companie.name' => 'required|string|max:255',
        'companie.morada' => 'required|string|max:255',
        'companie.cp' => 'required|string|max:10',
        'companie.cae' => 'required|string',
        'companie.localidade' => 'required|string|max:255',
        'companie.n_users' => 'required|integer|min:1',
        'companie.n_funcionarios' => 'required|integer|min:1',
        'companie.tipo_estabelecimento' => 'required|string|max:255',
        'companie.titulo_licenciamento' => 'required|string|max:255',
        'companie.emitido_licenciamento' => 'required|string|max:255',

    ];

    public function mount($estabelecimentoUui)
    {
        $this->estabelecimento = Company::where('uuid', $estabelecimentoUui)->first();
        $this->companie = $this->estabelecimento;

    }
    public function saveCompany(){
        // Aqui você pode adicionar validação dos dados
        if ($this->estabelecimento) {
            $this->estabelecimento->update([
                'name' => $this->companie['name'],
                'morada' => $this->companie['morada'],
                'cp' => $this->companie['cp'],
                'localidade' => $this->companie['localidade'],
                'n_users' => $this->companie['n_users'],
                'n_funcionarios' => $this->companie['n_funcionarios'],
                'tipo_estabelecimento' => $this->companie['tipo_estabelecimento'],
                'titulo_licenciamento' => $this->companie['titulo_licenciamento'],
                'cae' => $this->companie['cae'],
                'emitido_licenciamento'=> $this->companie['emitido_licenciamento'],
            ]);
            $this->emit('refreshPage');
        }
    }

    public function render()
    {
        return view('livewire.info-estabelecimento');
    }
}
