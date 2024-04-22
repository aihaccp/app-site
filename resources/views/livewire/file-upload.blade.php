<div class="modal-body">
    @if (session()->has('mensagem_sucesso'))
        <div class="alert alert-success">
            {{ session('mensagem_sucesso') }}
        </div>
    @endif

    <form wire:submit.prevent="salvar" enctype="multipart/form-data">
        @csrf
        @foreach ($linhas as $index => $linha)
            <div class="row" style="margin-top:1rem;">
                <!-- Coluna para o Nome -->
                <div class="col-md-4">
                    <label>Nome:</label>
                    <input type="text" wire:model="linhas.{{ $index }}.nome" class="form-control"
                        placeholder="Nome">
                </div>

                <!-- Coluna para o Ficheiro ou Upload -->
                <div class="col-md-4 text-center">
                    <label>Ficheiro:</label>
                    <div class="file-container">
                        @if (isset($linha['arquivo']) && $linha['arquivo'])
                            <a href="{{ Storage::url($linha['arquivo']) }}" target="_blank">
                                <i class="fas fa-file-alt"></i> <!-- Ícone de ficheiro -->
                                Ver Arquivo
                            </a>
                        @else
                            <input type="file" wire:model="linhas.{{ $index }}.arquivo"
                                class="form-control-file">
                        @endif
                    </div>
                </div>

                <!-- Coluna para o Botão de Remoção -->
                <div class="col-md-3 text-center">
                    <label>Eliminar:</label>
                    <button wire:click.prevent="removerLinha({{ $index }})" class="btn btn-danger">
                        <i class="fas fa-trash"></i> <!-- Ícone de lixeira -->
                    </button>
                </div>
            </div>
        @endforeach
        <button
            style="font-weight:400;background-color: black !important;border:0px;border-radius:0px;margin-top:1.5rem;"
            wire:click.prevent="adicionarLinha" class="btn btn-primary mb-3">+ Adicionar Linha</button>
    </form>

    <div class="modal-footer">

        <button style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
            wire:click="salvar" class="btn btn-primary">Guardar</button>
    </div>

</div>
