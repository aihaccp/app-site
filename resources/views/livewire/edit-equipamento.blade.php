<div class="container" style="margin-top:1.5rem;">
    <h2> <b>Equipamento: {{ $this->nome }}</b></h2>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form wire:submit.prevent="save">
        @csrf
        <div class="form-group">
            <label for="nome">Nome do Equipamento</label>
            <input type="text" class="form-control" id="nome" wire:model="nome">
        </div>
        <div class="form-group">
            <label>Tipo</label>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="temperatura" wire:model="tipo" id="temperatura">
                <label class="form-check-label" for="temperatura">
                    Medição de Temperatura
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="higienizacao" wire:model="tipo"
                    id="higienizacao">
                <label class="form-check-label" for="higienizacao">
                    Higienização
                </label>
            </div>
        </div>

        @if (in_array('temperatura', $tipo))
            <div class="form-group">
                <label for="temp_max">Temperatura Máxima</label>
                <input type="number" class="form-control" id="temp_max" wire:model="temp_max">
            </div>
            <div class="form-group">
                <label for="temp_min">Temperatura Mínima</label>
                <input type="number" class="form-control" id="temp_min" wire:model="temp_min">
            </div>
        @endif



        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
