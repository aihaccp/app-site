<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-2">
        <button wire:click="adicionarEquipamento" class="btn btn-primary">Adicionar Equipamento</button>
    </div>

    @foreach ($equipamentos as $index => $equipamento)
        <div class="mb-2">
            <input type="text" wire:model="equipamentos.{{ $index }}.nome" class="form-control d-inline-block"
                style="width: auto;" {{ $isBlocked ? 'disabled' : '' }}>
            <button wire:click="decrementar({{ $index }})" class="btn btn-secondary"
                {{ $isBlocked ? 'disabled' : '' }}>-</button>
            <span class="mx-2">{{ $equipamento['quantidade'] }}</span>
            <button wire:click="incrementar({{ $index }})" class="btn btn-secondary"
                {{ $isBlocked ? 'disabled' : '' }}>+</button>
        </div>
    @endforeach

    <button wire:click="salvar" style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
        type="button" class="btn btn-primary">Guardar</button>
</div>
