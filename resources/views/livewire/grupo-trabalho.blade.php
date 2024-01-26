<div class="modal-body">
    @if (session()->has('mensagem_sucesso'))
        <div class="alert alert-success">
            {{ session('mensagem_sucesso') }}
        </div>
    @endif
    @foreach ($grupos as $index => $grupo)
        <div class="row" style="margin-top:1rem;">
            <!-- Coluna para o Cargo -->
            <div class="col-md-4">
                <label>Tarefa:</label>
                <input type="text" wire:model="grupos.{{ $index }}.nome_cargo" class="form-control"
                    placeholder="Cargo">
            </div>
            <!-- Coluna para o Nome -->
            <div class="col-md-4">
                <label>Nome:</label>
                <input type="text" wire:model="grupos.{{ $index }}.name_resp" class="form-control"
                    placeholder="Nome">
            </div>
            <!--  <div class="col-auto">
                <label class="checkbox-inline">
                    <input type="checkbox" wire:model="grupos.{{ $index }}.mostrarInputAdicional">
                </label>
            </div>

           Input Adicional, se a Checkbox estiver marcada -->

            <div class="col-md-3">
                <label>Prestador de Serviços:</label>
                <input type="text" wire:model="grupos.{{ $index }}.name_outsourcing" class="form-control" placeholder="Serviço Externo (Opcional)">
            </div>

            <!-- Coluna para o Ícone de Remoção -->
            <div class="col-md-1">
                <label>Eliminar:</label>
                <button wire:click="removerGrupo({{ $index }})" class="btn btn-danger">
                    <i class="fas fa-trash"></i> <!-- Ícone de lixeira, você pode usar outro se preferir -->
                </button>
            </div>
        </div>
    @endforeach
    <button style="font-weight:40 0;background-color: black !important;border:0px;border-radius:0px;margin-top:1.5rem;"
        wire:click="adicionarGrupo" class="btn btn-primary mb-3">+ Adicionar</button>
    <div class="modal-footer">
        <button style="font-weight:40 0;background-color: black !important;border:0px;border-radius:0px" wire:click=""
            class="btn btn-primary">Cancelar</button>
        <button style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
            wire:click="salvar" class="btn btn-primary">Guardar</button>
    </div>
    <script>
        window.livewire.on('refreshPage', function() {
            window.location.reload();
        });
    </script>
</div>
