<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-2">
        <button wire:click="adicionarEspaco" class="btn btn-primary">Adicionar Espaço</button>
    </div>

    @foreach ($espacos as $index => $espaco)
        <div class="mb-2">
            <input type="text" wire:model="espacos.{{ $index }}.nome" class="form-control d-inline-block"
                style="width: auto;" {{ $isBlocked ? 'disabled' : '' }}>
            <button wire:click="decrementar({{ $index }})" class="btn btn-secondary"
                {{ $isBlocked ? 'disabled' : '' }}>-</button>
            <span class="mx-2">{{ $espaco['quantidade'] }}</span>
            <button wire:click="incrementar({{ $index }})" class="btn btn-secondary"
                {{ $isBlocked ? 'disabled' : '' }}>+</button>
        </div>
    @endforeach

    <div class="mb-2">
        <button wire:click="salvar" class="btn btn-success">Guardar</button>
    </div>
</div>


{{-- The best athlete wants his opponent at his best. --}}
