<x-app-layout>
    <div class="container">
        <h5 style="margin-top:0.8rem;">Home / Pré-Requisitos</h5>

        <div class="row" style="margin-top:2%">
            <div class="col-12 d-flex justify-content-end mb-3">
                <!-- Botão para abrir o modal de adicionar diretoria -->
                <button class="btn btn-success mr-2" data-toggle="modal" data-target="#adicionarDiretoriaModal">
                    <i class="fas fa-plus mr-1"></i> Adicionar Pré-Requisitos
                </button>

                <!-- Botão para abrir o modal de adicionar arquivo -->
                <button class="btn btn-primary" data-toggle="modal" data-target="#adicionarArquivoModal">
                    <i class="fas fa-file-upload mr-1"></i> Adicionar Documentos
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



        <div class="row" style="margin-top:2%">
            @foreach ($folders as $folder)
                <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-center"
                                style="height: 100%;margin-bottom:1.1rem;">
                                <i class="{{$folder->icon}}" style="margin-right: 1rem; align-self: center;"></i>
                                <h5 class="card-title" style="margin-bottom: 0;"><b>{{$folder->name}}</b></h5>
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
