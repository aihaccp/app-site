
<div class="col-md-8">
    <div class="row" style="margin-top:2%">
        <div class="col-12 d-flex justify-content-end mb-3">


            <!-- Botão para abrir o modal de adicionar arquivo -->
            <button class="btn btn-primary" data-toggle="modal" data-target="#adicionarArquivoModal">
                <i class="fas fa-file-upload mr-1"></i> Adicionar Documentos
            </button>
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
@livewire('add-files-prerequisitos-manager', ['folderId' => $folderId])

        </div>
    </div>
</div>
    <h4 style="margin-bottom:1.2rem;">Documentos</h4>
    @if(count($documents) > 0)
        @foreach($documents as $document)
            <div class="card mb-3 shadow-sm"> <!-- Adiciona margem abaixo e sombra leve -->
                <div class="card-body">
                    <!-- Ícone baseado na extensão do arquivo -->
                    @php
                        $extension = strtolower(pathinfo($document->avatar, PATHINFO_EXTENSION));
                    @endphp
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            @if($extension == 'docx' || $extension == 'doc')
                                <i class="fas fa-file-word text-primary fa-2x"></i>
                            @elseif($extension == 'pdf')
                                <i class="fas fa-file-pdf text-danger fa-2x"></i>
                            @elseif($extension == 'xlsx' || $extension == 'xls')
                                <i class="fas fa-file-excel text-success fa-2x"></i>
                            @endif
                            <span style="margin-left:1.2rem;" class="ms-3 fs-5">{{ $document->name }}</span> <!-- Adiciona espaçamento e tamanho de fonte -->
                        </div>

                        <!-- Ícones de ação -->
                        <div>
                            <a href="/storage/{{$document->avatar}}" style="font-size: 0.8rem;" target="_blank" class="btn btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="#" style="font-size: 0.8rem; background-color: black !important; color:white;" wire:click.prevent="downloadDocument({{ $document->id }})" class="btn ms-3">
                                <i class="fas fa-download"></i>
                            </a>

                            <a href="#" style="font-size: 0.8rem;" wire:click.prevent="deleteDocument({{ $document->id }})" class="btn btn-danger ms-3">
                                <i class="fas fa-trash-alt"></i>
                            </a>

                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info">Não há documentos disponíveis para este folder.</div>
    @endif

</div>
