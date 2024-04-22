<?php

namespace App\Http\Livewire;

use App\Models\Auditoria;
use App\Models\AuditoriaResposta;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ShowRegistosAuditorias extends Component
{
    public $auditoria;
    public $respostasPorDia = [];

    public function mount($auditoria)
    {
        $this->auditoria = $auditoria->id;
        $this->loadRespostas();
    }

    public function loadRespostas()
    {
        $respostas = AuditoriaResposta::where('id_auditoria', $this->auditoria)
            ->orderBy('created_at', 'desc')
            ->get();

        $grouped = [];
        foreach ($respostas as $resposta) {
            $grouped[$resposta->block][] = $resposta;
        }

        $this->respostasPorDia = $grouped;
    }
    public function render()
    {
        return view('livewire.show-registos-auditorias');
    }
}
