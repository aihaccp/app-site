<div>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .fas {
            color: black;
            /* Cor do ícone */
        }

        .card:hover .fas {
            color: #4a4a4a;
            /* Cor do ícone no hover */
        }
    </style>
    <div class="container">
        <div class="row">
            @foreach ($spaces as $space)
                <div class="col-md-4 mb-3">
                    <a href="" data-toggle="modal" data-target="#meuModal{{ $space->id }}"
                        style=" color: inherit; text-decoration: none; cursor: default;">
                        <div class="card" style="cursor: pointer;"
                            wire:click="$emit('openModal', {{ $space->id }})">
                            <div class="card-body text-center">
                                {{-- Substitua 'fa-building' pelo ícone desejado --}}
                                @if ($space->equipments()->exists())
                                    <!-- Verifica se existem equipamentos -->
                                    <i style="color:green" class="fas fas fa-check"></i> <!-- Ícone para espaço com equipamentos -->
                                    <span>({{ $space->equipments->count() }} equipamentos)</span>
                                @else
                                    <i style="color:#fcc000" class="fas fa-tools"></i> <!-- Ícone para espaço sem equipamentos -->
                                    <span>({{ $space->equipments->count() }} equipamentos)</span>
                                @endif
                                <h5 class="card-title">
                                    🛋️ {{ $space->designacao }}
                                </h5>
                                <!-- Estrutura do Modal -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="modal fade" id="meuModal{{ $space->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="modalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="background-color: rgb(254, 248, 241)" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel">Regista os teus equipamentos: {{ $space->designacao }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                @livewire('add-equipment', ['spaceId' => $space->id])
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</div>
