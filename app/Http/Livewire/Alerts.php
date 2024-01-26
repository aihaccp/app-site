<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Alerts extends Component
{
    public $alertaAtivo;

    protected $listeners = ['ativarAlerta'];

    public function mount()
    {
        $this->alertaAtivo = false;
    }

    public function ativarAlerta()
    {
        $this->alertaAtivo = true;
    }

    public function render()
    {
        return view('livewire.alerts');
    }
}
