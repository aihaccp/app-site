<?php

namespace App\Http\Livewire;

use App\Models\Auditoria;
use App\Models\AuditoriaPergunta;
use App\Models\Frequencia;
use Livewire\Component;

class EditAuditoria extends Component
{
    public $auditoriaId;
    public $auditoria;
    public $name;
    public $frequency;
    public $questions = [];

    public function mount(Auditoria $auditoria)
    {
        $this->auditoriaId = $auditoria->uuid;
        $this->auditoria = $auditoria;
        $this->name = $auditoria->name;
        $this->frequency = $auditoria->id_frequencia;
        $this->questions = AuditoriaPergunta::where('id_auditoria', $auditoria->id)->get()->toArray();

    }

    public function save()
    {
        $auditoria = Auditoria::find($this->auditoria->id);

        $auditoria->update([
            'name' => $this->name,
            'id_frequencia' => $this->frequency,
        ]);

        // Atualizar as perguntas
        foreach ($this->questions as $index => $data) {

            $question = AuditoriaPergunta::where('id', $data['id'])->first();
            if ($question) {
                $question->update([
                    'nome' => $data['nome'],
                    'tipo_pergunta' => $data['tipo_pergunta'],
                ]);
            }
        }

        session()->flash('message', 'Auditoria atualizada com sucesso!');
    }

    public function render()
    {
        return view('livewire.edit-auditoria', [
            'frequencies' => Frequencia::all()
        ]);
    }
}
