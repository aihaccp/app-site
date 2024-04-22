<x-app-layout>
    <div class="container">
        <h5 style="margin-top:0.8rem;">Home / {{ $module->name }}</h5>
        @if (strcmp($module->slug, 'verificacoes') == 0)
            <div class="row" style="margin-top:2%">
                <div class="col-12 d-flex justify-content-end mb-3">
                    <!-- Botão para abrir o modal de adicionar diretoria -->
                    <button class="btn btn-success mr-2" data-toggle="modal" data-target="#adicionarDiretoriaModal">
                        <i class="fas fa-plus mr-1"></i> Adicionar Auditoria
                    </button>

                    <!-- Botão para abrir o modal de adicionar arquivo -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#adicionarArquivoModal">
                        <i class="fas fa-file-upload mr-1"></i> Adicionar Perguntas à Auditoria
                    </button>
                </div>

            </div>
            <div class="modal fade" id="adicionarDiretoriaModal" tabindex="-1" role="dialog"
                aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Adicionar Auditoria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Modal para adicionar arquivo -->
            <div class="modal fade" id="adicionarArquivoModal" tabindex="-1" role="dialog"
                aria-labelledby="modalLabelArquivo" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelArquivo">Adicionar Perguntas à Auditoria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        @endif

        @if (strcmp($module->name, 'Documentos') == 0)
            <div class="row" style="margin-top:2%">
                <div class="col-12 d-flex justify-content-end mb-3">
                    <!-- Botão para abrir o modal de adicionar diretoria -->
                    <button class="btn btn-success mr-2" data-toggle="modal" data-target="#adicionarDiretoriaModal">
                        <i class="fas fa-plus mr-1"></i> Pasta/Diretoria
                    </button>

                    <!-- Botão para abrir o modal de adicionar arquivo -->
                    <button class="btn btn-primary" data-toggle="modal" data-target="#adicionarArquivoModal">
                        <i class="fas fa-file-upload mr-1"></i> Adicionar Arquivo
                    </button>
                </div>

            </div>

            <!-- Modal para adicionar diretoria -->
            <div class="modal fade" id="adicionarDiretoriaModal" tabindex="-1" role="dialog"
                aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Adicionar Nova Diretoria</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @livewire('add-folder-form')
                    </div>
                </div>
            </div>

            <!-- Modal para adicionar arquivo -->
            <div class="modal fade" id="adicionarArquivoModal" tabindex="-1" role="dialog"
                aria-labelledby="modalLabelArquivo" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabelArquivo">Adicionar Novo Arquivo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @livewire('add-file-form')
                    </div>
                </div>
            </div>
        @endif

        <div class="row" style="margin-top:2%">
            @foreach ($folders as $folderAux)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100 folder-card {{ $folderAux->disabled ? 'disabled-folder' : '' }}"
                        onclick="location.href='{{ route('folders-show', ['moduleSlug' => $module->slug, 'folderSlug' => $folderAux->slug, 'fileSlug' => 'arquivo', 'uuid' => session('uuid')]) }}'"
                        style="cursor: pointer; transition: transform .2s, box-shadow .2s;">
                        <div class="card-body">
                            <div class="media align-items-center">
                                <i class="fas fa-folder" style="font-size:2.5rem;margin-right:1rem;"></i>
                                <div class="media-body">
                                    <h5 class="mt-0">{{ $folderAux->name }}</h5>
                                </div>
                            </div>
                        </div>

                    </div>
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
