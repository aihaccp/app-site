<?php

namespace App\Http\Livewire;

use App\Models\CardsHACCP;
use App\Models\Company;
use Livewire\Component;

class HaccpPlan extends Component {

    public $estabelecimento;
    public $cards_plan_haccp;
    public function mount() {
        $uuid = session('uuid');
        $estabelecimentoGeral = Company::where('uuid', $uuid)->first();
        $this->estabelecimento = $estabelecimentoGeral;
        $this->cards_plan_haccp = CardsHACCP::where('status', 1)->get();


    }

    public $showModal = false;
    public $content = '';
    public $titulo = '';

    public function toggleModal($content,$titulo) {
        $this->content = $content;
        $this->titulo = $titulo;
        $this->showModal = !$this->showModal;
    }

    public function closeModal() {
        $this->showModal = false;
    }

    public function render() {
        return view('livewire.haccp-plan');
    }
}
