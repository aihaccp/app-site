<div class="container py-5">
    <style>
        .progress-bar {
            background: linear-gradient(90deg, rgba(86, 109, 249, 1) 0%, rgba(113, 40, 202, 1) 0%, rgba(14, 37, 162, 1) 100%);
        }
    </style>
    <!-- Passo Títulos & Progresso -->
    <div class="row mb-3">
        <div class="col-4 text-center">
            <h5><b>Preenchimento </b></h5>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                    aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-4 text-center">
            <h5><b>Validação</b></h5>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $currentStep >= 2 ? '100' : '0' }}%"
                    aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
        <div class="col-4 text-center">
            <h5><b>Conclusão SGSG</b></h5>
            <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{ $currentStep == 3 ? '100' : '0' }}%"
                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <!-- Área do Formulário do Passo Atual -->
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @if ($currentStep == 1)
                        @livewire('haccp-plan')
                        <div class="d-flex flex-column" style="min-height: 100%;">
                            <form wire:submit.prevent="submit" class="w-100">
                                <!-- Campos do Formulário da Etapa 1 -->
                                <!-- O resto do seu formulário vai aqui -->

                                <!-- Botão alinhado à direita no final da div -->
                                <div class="d-flex justify-content-end mt-3">
                                    <button style="font-weight:200;background-color: black !important;border:0px;"
                                        type="button" class="btn btn-primary"
                                        wire:click="goToNextStep">Próximo</button>
                                </div>
                            </form>
                        </div>
                    @elseif($currentStep == 2)
                        <div class="container">
                            @livewire('steps-validations')


                        </div>
                    @elseif($currentStep == 3)
                        @livewire('steps-visualization')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
