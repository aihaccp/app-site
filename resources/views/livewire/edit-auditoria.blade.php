<div class="scrollable-container">
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
    <style>
        .scrollable-container {
            max-height: 80vh;
            /* ou a altura que você deseja */
            overflow-y: auto;
            /* habilita a barra de rolagem vertical */
            overflow-x: hidden;
            /* desabilita a barra de rolagem horizontal */
        }
    </style>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" wire:model="name" placeholder="Digite seu nome">
        </div>

        <div class="form-group">
            <label for="frequency">Frequência:</label>
            <select class="form-control" id="frequency" wire:model="frequency">
                <option value="">Selecione a frequência</option>
                @foreach ($frequencies as $frequency)
                    <option value="{{ $frequency->id }}">{{ $frequency->designacao }}</option>
                @endforeach
            </select>
        </div>

        <div>
            @foreach ($questions as $index => $question)
                <div class="form-group">
                    <label for="question-{{ $index }}"><b>Pergunta {{ $index + 1 }}:</b></label>
                    <input type="text" class="form-control" id="question-{{ $index }}"
                        wire:model="questions.{{ $index }}.nome" placeholder="Digite a pergunta">

                    <label for="type-{{ $index }}">Tipo:</label>
                    <select class="form-control" id="type-{{ $index }}"
                        wire:model="questions.{{ $index }}.tipo_pergunta">
                        <option value="yesno">Escolha (Sim/Não)</option>
                        <option value="text">Campo Texto</option>
                    </select>
                </div>
            @endforeach
        </div>

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
        <button type="submit" class="btn btn-primary" style="background-color: black; border: 0;">Salvar
            Alterações</button>
    </form>


</div>
