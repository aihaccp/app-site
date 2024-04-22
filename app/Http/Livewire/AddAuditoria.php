<?php

namespace App\Http\Livewire;

use App\Models\Auditoria;
use App\Models\AuditoriaPergunta;
use App\Models\Company;
use App\Models\Frequencia;
use Livewire\Component;

class AddAuditoria extends Component
{
    public $name;
    public $questions = [];
    public $estabelecimentoGeral;
    public $frequencies = [];
    public $frequency;

    public function mount()
    {
        $uuid = session('uuid');
        $this->estabelecimentoGeral = Company::where('uuid', $uuid)->first();
        $this->frequencies = Frequencia::all();
        $this->addQuestion();
    }
    public function addQuestion()
    {
        // Inicializa cada pergunta com um tipo padrão e texto vazio
        $this->questions[] = ['text' => '', 'type' => 'yesno'];
    }
    public function saveForm()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'frequency' => 'required',
            'questions.*.text' => 'required|string|max:255',
            'questions.*.type' => 'required'
        ]);

        // Verificar duplicidade
        $duplicate = Auditoria::where('name', $this->name)
            ->where('id_empresa', $this->estabelecimentoGeral->id)
            ->where('id_frequencia', $this->frequency)
            ->exists();

        if ($duplicate) {
            session()->flash('error', 'Uma auditoria com este nome e frequência já existe para esta empresa.');
            return;
        }

        // Salvar a auditoria
        $auditoria = new Auditoria();
        $auditoria->name = $this->name;
        $auditoria->id_empresa = $this->estabelecimentoGeral->id;
        $auditoria->id_frequencia = $this->frequency;
        $auditoria->save();

        // Salvar as perguntas
        foreach ($this->questions as $question) {
            AuditoriaPergunta::create([
                'nome' => $question['text'],
                'tipo_pergunta' => $question['type'],
                'id_auditoria' => $auditoria->id,
            ]);
        }
        // Limpar os campos
        $this->resetForm();

        session()->flash('message', 'Auditoria guardada com sucesso!');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->frequency = null;
        $this->questions = [];
    }
    public function render()
    {
        return view('livewire.add-auditoria');
    }
}
