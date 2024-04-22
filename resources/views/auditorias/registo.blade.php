<x-app-layout>
    <!-- Card que aciona o modal -->
    <div class="row" style="margin-top:2%">
        <div class="col-12 d-flex justify-content-start mb-3">
            <!-- Botão para abrir o modal de adicionar diretoria -->
            <button class="btn btn-success mr-2" style="background-color: black; border: 0;" onclick="history.back();">
                <i class="fas fa-chevron-left mr-1"></i> Voltar atrás
            </button>
        </div>

    </div>
    <div class="row" style="margin-top:2%">
        @livewire('auditoria-question-manager', ['auditoria' => $auditoria])
    </div>

</x-app-layout>
