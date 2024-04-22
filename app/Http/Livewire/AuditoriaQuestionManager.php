<?php

namespace App\Http\Livewire;

use App\Models\Auditoria;
use App\Models\AuditoriaResposta;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;
class AuditoriaQuestionManager extends Component
{
    public $auditoria;
    public $questions = [];
    public $block;
    protected $rules = [
        'questions.*.resposta' => 'required', // Adicione regras específicas conforme necessário
    ];
    public function mount(Auditoria $auditoria)
    {
        $this->auditoria = $auditoria;

        $this->questions = $auditoria->perguntas()->get();

        if (empty($this->block)) {
            $this->block = (string) \Webpatser\Uuid\Uuid::generate(4);
        }
        \Log::info('Montando o componente, UUID atual: ' . $this->block);

    }

    public function saveResponses()
    {

        $this->validate();

        foreach ($this->questions as $question) {

            // Evitar salvar se a resposta é nula
            if (!empty($question['resposta'])) {
                AuditoriaResposta::create(
                    [
                        'block' => $this->block,
                        'id_pergunta' => $question['id'],
                        'id_auditoria' => $this->auditoria->id,
                        'id_user' => auth()->id(),
                        'resposta' => $question['resposta']
                    ]
                );
                \Log::info('Montando o componente, UUID atual: ' . $this->block);
            }else{
                session()->flash('error', 'Por favor responde às perguntas');
            }
        }

        session()->flash('message', 'Respostas atualizadas com sucesso!');
    }


    public function render()
    {
        return view('livewire.auditoria-question-manager');
    }
}
