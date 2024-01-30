<?php

namespace App\Http\Livewire;

use Livewire\Component;
use GuzzleHttp\Client;

class Chatbot extends Component
{
    public $messages = [];
    public $inputMessage = '';
    public $questionCount = 0;
    public $maxQuestions = 3;

    public function mount()
    {
        $this->questionCount = session('questionCount', 0);
    }
    public function sendMessage()
    {
        if (!empty($this->inputMessage)) {
            // Adiciona a mensagem do usuário ao array de mensagens
            $this->questionCount++;
            session(['questionCount' => $this->questionCount]);
            $this->messages[] = ['text' => $this->inputMessage, 'type' => 'user'];
            if ($this->questionCount >= $this->maxQuestions) {
                $this->messages[] = ['text' => 'Atingiste o limite máximo de perguntas ao Jaleca. Amanhã tiro-te as dúvidas.', 'type' => ''];
                return;
            }

            // Cria uma instância do cliente Guzzle
            $client = new Client();

            try {
                // Envia a requisição POST para a API
                $response = $client->request('POST', 'http://ec2-3-80-247-173.compute-1.amazonaws.com:8000/gpt-assistant/', [
                    'json' => ['message' => $this->inputMessage]
                ]);


                // Decodifica a resposta JSON
                $responseData = json_decode($response->getBody(), true);
                // Adiciona a resposta da API ao array de mensagens
                if (!empty($responseData) && isset($responseData)) {
                    $this->messages[] = ['text' => $responseData, 'type' => 'bot'];
                } else {
                    // Caso a resposta da API esteja vazia ou mal formatada
                    $this->messages[] = ['text' => 'Resposta não recebida ou em formato inválido.', 'type' => 'bot'];
                }
            } catch (\Exception $e) {
                // Tratar exceção
                $this->messages[] = ['text' => 'Erro ao enviar mensagem: ' . $e->getMessage(), 'type' => 'bot'];
            }

            // Limpa a mensagem de input
            $this->inputMessage = '';
        }
    }


    public function render()
    {
        return view('livewire.chatbot');
    }

}
