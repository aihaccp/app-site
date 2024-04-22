<x-app-layout>
    <!-- Card que aciona o modal -->
    <div class="row" style="margin-top:2%">
        <div class="col-12 d-flex justify-content-end mb-3">
            <!-- Botão para abrir o modal de adicionar diretoria -->
            <button class="btn btn-success mr-2" style="background-color: black; border: 0;" data-toggle="modal"
                data-target="#cardModal">
                <i class="fas fa-cog mr-1"></i> Editar {{ $auditoria->name }}
            </button>
        </div>

    </div>
    <div class="row" style="margin-top:2%">
        @livewire('show-registos-auditorias', ['auditoria' => $auditoria])

    </div>
    <!-- Modal -->
    <div class="modal fade" id="cardModal" tabindex="-1" role="dialog" aria-labelledby="cardModalLabel"
        aria-hidden="true" style="overflow-x: hidden; overflow-y: auto;background-color: rgb(0,0,0,0.5);">
        <div class="modal-dialog" style="max-width: 85%; margin: 0; margin-left: auto;" role="document">
            <div class="modal-content" style="height: 100vh;background-color:#FEF9F2">
                <div class="modal-header">
                    <h5 class="modal-title" id="cardModalLabel">Adicionar Auditoria</h5>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                        style="background-color: black; border: 0;">Fechar</button>
                </div>
                <div class="modal-body">
                    @livewire('edit-auditoria', ['auditoria' => $auditoria])

                    <!-- Pode incluir outro componente ou informações dinâmicas -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
