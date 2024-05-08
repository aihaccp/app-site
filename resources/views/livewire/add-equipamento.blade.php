@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif
<form wire:submit.prevent="addEquipamento">
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

    @if(in_array('temperatura', $this->tipo))
    <div class="form-group">
        <label for="temp_max">Temperatura Máxima</label>
        <input type="number" class="form-control" id="temp_max" wire:model="temp_max">
    </div>
    <div class="form-group">
        <label for="temp_min">Temperatura Mínima</label>
        <input type="number" class="form-control" id="temp_min" wire:model="temp_min">
    </div>
    @endif

    <button type="submit" class="btn btn-primary" style="font-weight:400;background-color: black !important;border:0px;border-radius:0px">Adicionar Equipamento</button>
</form>
