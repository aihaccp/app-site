<div class="container">
    @foreach ($respostasPorDia as $block => $respostasDoBloco)
        <div class="card mb-3">
            <div class="card-header">
                Block: {{ $block }}
            </div>
            <ul class="list-group list-group-flush">
                @foreach ($respostasDoBloco as $resposta)
                    <li class="list-group-item">
                        Pergunta: {{ $resposta->pergunta->nome }}, Resposta: {{ $resposta->resposta }}
                        <br>
                        Submetido em: {{ $resposta->created_at->format('d/m/Y H:i:s') }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endforeach
</div>
