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
            <div class="modal fade" id="adicionarDiretoriaModal" tabindex="-1" role="dialog"
                aria-labelledby="modalLabel" aria-hidden="true">
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

            <!-- Modal para adicionar arquivo -->
            <div class="modal fade" id="adicionarArquivoModal" tabindex="-1" role="dialog"
                aria-labelledby="modalLabelArquivo" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelArquivo">Adicionar Documentos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

        <div class="row" style="margin-top:2%">


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
