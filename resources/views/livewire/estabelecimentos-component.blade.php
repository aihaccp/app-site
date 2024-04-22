<div>
    <div class="row">
        @foreach ($estabelecimentos as $index => $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow" wire:click="redirectToDashboard('{{ $item->uuid }}')">
                    @if ($item->image_url)
                        <!-- Imagem do Estabelecimento -->
                        <img src="{{ $item->image_url }}" alt="{{ $item->name }}" class="card-img-top">
                    @else
                        <!-- Ícone Padrão para Estabelecimentos sem Imagem -->
                        <div class="card-img-top icon-default">
                            <i class="fas fa-store fa-2x"></i>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            {{ $item->name ?? 'Estabelecimento ' . ($index + 1) }}
                        </h5>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow">

                    <!-- Imagem do Estabelecimento -->
                    <img src="/img/add_estabelecimento.jpg" alt="Add" class="card-img-top">

                    <!-- Ícone Padrão para Estabelecimentos sem Imagem -->


            </div>
        </div>
    </div>
    <style>.card-img-top {
        width: 100%; /* Faz a imagem ocupar toda a largura do card */
        height: auto; /* Mantém a proporção da imagem */
        object-fit: cover; /* Garante que a imagem cubra toda a área sem distorção */
    }

    .icon-default {
        width: 100%;
        height: 150px; /* Altura fixa para ícones padrão */
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa; /* Cor de fundo para ícones padrão */
    }
    </style>
</div>
