<x-app-layout>
    <div class="container">
        <h5 style="margin-top:0.8rem;">Home / Espaços</h5>

        <div class="row" style="margin-top:2%">
            <div class="col-12 d-flex justify-content-end mb-3">
                <!-- Botão para abrir o modal de adicionar diretoria -->
                <button class="btn btn-success mr-2" data-toggle="modal" data-target="#adicionarDiretoriaModal">
                    <i class="fas fa-plus mr-1"></i> Adcionar Espaco
                </button>
            </div>
        </div>

        <!-- Modal para adicionar diretoria -->
        <div class="modal fade" id="adicionarDiretoriaModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Adicionar Novo Espaco</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @livewire('add-espaco-form')
                </div>
            </div>
        </div>

        <div class="row" style="margin-top:2%">
            @foreach ($espacos as $espaco)
                <div class="col-lg-4 col-md-6 mb-4">
                    <a href="{{ route('equipamentos', $espaco->uuid) }}?uuid={{session('uuid')}}">
                        <div class="card border-0 shadow-sm h-100 folder-card"
                            style="cursor: pointer; transition: transform .2s, box-shadow .2s;">
                            <div class="card-body">
                                <div class="media align-items-center">
                                    <i class="fas fa-building" style="font-size:2rem;"></i>
                                    <div class="media-body">
                                        <h5 class="mt-0" style="margin-left: 0.8rem">{{ $espaco->designacao }}</h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </a>
                </div>
            @endforeach

            <style>
                .folder-card:hover {
                    transform: translateY(-5px);
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
                }

                .disabled-folder {
                    pointer-events: none;
                    opacity: 0.6;
                }
            </style>

        </div>
    </div>




</x-app-layout>
