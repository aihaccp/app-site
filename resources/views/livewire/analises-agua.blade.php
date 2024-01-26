<div class="modal-body">
    @if (session()->has('mensagem_sucesso'))
        <div class="alert alert-success">
            {{ session('mensagem_sucesso') }}
        </div>
    @endif

    <div class="row" style="margin-top:1rem;">
        <!-- Coluna para o Tipo de Abastecimento -->
        <div class="col-md-3" style="margin-bottom:1.5rem">
            <label>Tipo de Abastecimento:</label>
            <select wire:model="networkType" class="form-control">
                <option value="Publica">Rede Pública</option>
                <option value="Propria">Rede Própria</option>
            </select>
        </div>
    </div>

    <div class="modal-footer">
        <button style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
                wire:click="save" class="btn btn-primary">Guardar</button>
    </div>

    <script>
        window.livewire.on('refreshPage', function() {
            window.location.reload();
        });
    </script>
</div>
