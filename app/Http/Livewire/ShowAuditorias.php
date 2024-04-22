<?php

namespace App\Http\Livewire;

use App\Models\Auditoria;
use App\Models\Company;
use Livewire\Component;

class ShowAuditorias extends Component
{
    public $estabelecimentoGeral;
    public $uuid;
    public function mount(){

        $this->uuid = session('uuid');
        $this->estabelecimentoGeral = Company::where('uuid', $this->uuid)->first()->id;
    }
    public function render()
    {
        $auditorias = Auditoria::where('id_empresa',$this->estabelecimentoGeral)->get();
        return view('livewire.show-auditorias', ['auditorias' => $auditorias]);
    }
}
