<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\ProdutoQuimico;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class OpenAiController extends Controller
{
    public function index()
    {
        $id_empresa = 72;
        $areas = Area::where('id_empresa', 72)->get();
        // Formata os dados para a estrutura desejada
        $dados = $areas->map(function ($area) {
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

        $client = new Client();
        $url = 'http://ec2-3-80-247-173.compute-1.amazonaws.com:8000/chat-with-assistant/'; // Substitua com a URL correta da sua API FastAPI

        try {
            // Supõe-se que $dados é um array ou objeto PHP
            $dadosjson = response()->json($dados);

            $userMessage = "Quero ter respostas em pt_pt e de acordo com os exemplos da asae(na designacao dizer apenas tipo de produto ou o nome, não enumerar prodquimico1 etc ou algo do genero): '$dadosjson' Apartir deste json cria-me uma tabela produtos_quimico em json com Colunas: designacao(nome do produto quimico), dosagem, modo_preparacao, tempo_acao de acordo com a ASAE pt";

            // Envia a requisição POST
            $response = $client->request('POST', $url, [
                'json' => ['message' => $userMessage]
            ]);

            $body = $response->getBody();
            $arrayExterna = json_decode($body);
            $content = json_decode($arrayExterna);

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
}
