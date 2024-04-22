<div>
    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @elseif (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Restante do formulário aqui -->
    </div>
    <table class="table">

        <thead>
            <tr>
                <th>Pergunta</th>
                <th>Resposta</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($questions as $index => $question)
                <tr>
                    <td>{{ $question['nome'] }}</td>
                    <td>
                        @if ($question['tipo_pergunta'] === 'yesno')
                            <select class="form-control" wire:model="questions.{{ $index }}.resposta">
                                <option value="">Selecione</option>
                                <option value="yes">Sim</option>
                                <option value="no">Não</option>
                            </select>
                            @error('questions.' . $index . '.resposta')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @elseif ($question['tipo_pergunta'] === 'text')
                            <input type="text" class="form-control"
                                wire:model="questions.{{ $index }}.resposta">
                            @error('questions.' . $index . '.resposta')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <button wire:click="saveResponses" class="btn btn-success" style="background-color: black; border: 0;">Salvar
        Respostas</button>
</div>
