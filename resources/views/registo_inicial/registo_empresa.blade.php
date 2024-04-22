@extends('layouts.appregisto')

@section('robot-image', 'img/mascote_fala.png')

@section('right-section')
    <div class="col-md-8 full-height"
        style="background-color: #FEF9F2; display: flex; flex-direction: column; padding-top:3.5rem">
        <h2><b>👋 Bem vindo/a </b></h2>
        <p>⏳ Tempo de registo: 10 minutos</p>
        <div class="scrollable-content">
            <livewire:nif-search />
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="bemvindo">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: rgb(250, 250, 250);border: 0rem;">
                <!-- Cabeçalho do modal -->
                <!-- Corpo do modal -->
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">👋Bem-vindo/a à AiHACCP!👋</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body text-center d-flex flex-column align-items-center">
                    <p class="" id="modalLabel">Eu sou a Jaleca!</p>
                    <img src="img/mascote_aihaccp.png" alt="Verificação" style="width: 15rem" class="img-fluid mb-3">
                    <p class="" id="modalLabel">Vou acompanhar o teu registo.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- CSS do Bootstrap -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#bemvindo").modal('show');
        });
    </script>
@endsection
