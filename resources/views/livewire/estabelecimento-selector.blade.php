<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        style="background-color: white; color: black; font-weight: 700; border: 0px;">
        <i class="far fa-building"></i>
        <span>{{ $estabelecimentoSelecionadoNome }}</span>
    </button>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
        @foreach($estabelecimentos as $estabelecimento)
            <a class="dropdown-item" href="#" wire:click.prevent="selectEstabelecimento('{{ $estabelecimento->uuid }}', '{{ $estabelecimento->name }}')">{{ $estabelecimento->name }}</a>
        @endforeach
    </div>
    <script>
        window.livewire.on('refreshPage', function() {
            window.location.reload();
        });
    </script>
</div>

