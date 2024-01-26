<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Company;
use App\Models\Frequencia;
use App\Models\PlanoHigienizacao;
use App\Models\ProdutoQuimico;
use App\Models\TipoAcao;
use GuzzleHttp\Client;
use Livewire\Component;

class ProgressComponent extends Component
{
    public $estabelecimento;
    public function mount($estabelecimentoUui)
    {
        $this->estabelecimento = Company::where('uuid', $estabelecimentoUui)->first();
    }
    public function generateHaccp()
    {
        set_time_limit(150);
        $areas = Area::where('id_empresa', $this->estabelecimento->id)->get();
        // Formata os dados para a estrutura desejada
        $areapEquipamento = $areas->map(function ($area) {
            return [
                'id' => $area->id,
                'nome' => $area->designacao,
                'equipamentos' => $area->equipments->map(function ($equipamento) {
                    return [
                        'id' => $equipamento->id,
                        'nome' => $equipamento->nome
                    ];
                })
            ];
        });
        $tipo_acao1 = TipoAcao::all();
        $tipo_acao = $tipo_acao1->map(function ($tipo_aca) {
            return [
                'id' => $tipo_aca->id,
                'designacao' => $tipo_aca->designacao
            ];
        });

        $frequencias = Frequencia::all();
        $frequencia1 = $frequencias->map(function ($frequencia) {
            return [
                'id' => $frequencia->id,
                'designacao' => $frequencia->designacao
            ];


        });
        $pprodutosquimicos = ProdutoQuimico::where('id_empresa', $this->estabelecimento->id)->get();
        $quimicosdados = $pprodutosquimicos->map(function ($p) {
            return [
                'id' => $p->id,
                'designacao' => $p->designacao
            ];
        });

        $planos = PlanoHigienizacao::where('id_empresa', $this->estabelecimento->id)->get();
        $planosdados = $planos->map(function ($p) {
            return [
                'id' => $p->id,
                'id_empresa' => $p->id_empresa,
                'id_area' => $p->id_area
            ];
        });


        $message1 = "Retorna json o item_acao_frequencia completa, com base nos documentos e na asae. De acordo com todos os equipamentos que fazem parte em cada espaço do estabelecimento:
'$areapEquipamento', com a tabela tipo_acao ==>'$tipo_acao', a tabela frequencia ==>[ '$frequencia1' ] e a tabela produtos_quimicos==>['$quimicosdados']e a tabela plano_higianizacao==>['$planosdados']. As tabelas de itens de higienização sejam preenchidas com as informações dos equipamentos em cada espaço, os tipos de ação, as frequências, os produtos químicos e os planos de higienização.\n";

        $message= (json_encode($message1));

        $client = new Client();
        $url = 'http://localhost:5000/gpt-assistant/'; // Substitua com a URL correta da sua API FastAPI

        try {
            // Supõe-se que $dados é um array ou objeto PHP

            // Envia a requisição POST
            $response = $client->request('POST', $url, [
                'json' => ['message' => $message]
            ]);

            $body = $response->getBody();
            $arrayExterna = json_decode($body);
            $content = json_decode($arrayExterna);
            dd($content);

            // Verifica se $content é realmente um array
            if (json_last_error() === JSON_ERROR_NONE) {
                foreach ($content as $obj) {
                    // Verifica se cada item é um array válido
                    $obj1 = json_decode($obj, true);
                    if (is_array($obj1)) {
                        if (ProdutoQuimico::where('designacao', $obj1['designacao'])->count() == 0) {
                            $produtoquimico = new ProdutoQuimico;
                            $produtoquimico->designacao = $obj1['designacao'] ?? null;
                            $produtoquimico->dosagem = $obj1['dosagem'] ?? null;
                            $produtoquimico->modo_preparacao = $obj1['modo_preparacao'] ?? null;
                            $produtoquimico->tempo_acao = $obj1['tempo_acao'] ?? null;
                            $produtoquimico->id_empresa = 7;
                            $produtoquimico->save();
                        }
                    } else {
                        echo "Item inválido.\n";
                    }
                }
            } else {
                echo "Erro ao decodificar o JSON: " . json_last_error_msg();
            }

            return response()->json();
        } catch (\Exception $e) {
            // Tratar exceção
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
    public function render()
    {
        return view('livewire.progress-component');
    }
}
