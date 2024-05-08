<x-app-layout>
    <div class="container">
        <h5 style="margin-top:0.8rem;">Home / Pré-Requisitos</h5>

        <div class="row" style="margin-top:2%">
            <div class="col-12 d-flex justify-content-end mb-3">
                <!-- Botão para abrir o modal de adicionar diretoria -->
                <button class="btn btn-success mr-2" data-toggle="modal" data-target="#adicionarDiretoriaModal">
                    <i class="fas fa-plus mr-1"></i> Adicionar Pré-Requisitos
                </button>


            </div>

        </div>
        <div class="modal fade" id="adicionarDiretoriaModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Adicionar Pré-Requisitos</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @livewire('prerequisitos-manager')
                </div>
            </div>
        </div>


        <style>
            .flex-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 1.1rem;
                height: 100%;
            }
            .icon-name {
                display: flex;
                align-items: center;
                margin-right: 20px; /* Margem entre ícone/nome e texto */
            }
            .icon-name i {
                margin-right: 1rem;
            }
            .text-right {
                font-size: 0.8rem;
                margin-bottom: 0;
                text-align:left !important; /* Alinha o texto à esquerda */
            }
        </style>



        <div class="row" style="margin-top:2%">
            @foreach ($folders as $folder)
                <div class="col-lg-9 col-md-9 col-sm-9 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div class="flex-container">
                                <div class="icon-name">
                                    <i class="{{$folder->icon}}"></i>
                                    <h5 class="card-title"><b>{{$folder->name}}</b></h5>
                                </div>
                                <p class="text-right">{{$folder->text}}</p>
                            </div>


                            <div class="mt-auto">

                                <a href="/pre-requisito/{{$folder->slug}}?uuid={{ session('uuid') }}" class="btn btn-primary btn-block"
                                    style="background-color: black; border: 0;">Ver Detalhes</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

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
