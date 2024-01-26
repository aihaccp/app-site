<div class="container" style="margin-top:4rem;margin-bottom:3rem;">
    <div class="align-items-center" style="display: flex;align-items: center;">
        <img src="{{ asset('img/mascote_aihaccp.png') }}" style="height:2.2rem;margin-bottom:1rem;" alt="Jaleca">
        <h2 style="margin-bottom:1rem; font-size:2rem;"><b>Cria o teu HACCP</b></h2>
    </div>


    <div class="row">
        <!-- Coluna 1 -->
        @php
            $i=1;
        @endphp
        @foreach ($cards_plan_haccp as $card)
            <div class="col-md-12" style="margin-bottom:2rem;">
                <div class="card shadow" style="border-color:green; border:1.5rem;">
                    <button wire:click="toggleModal('{{ $card->livewire }}','{{ $card->nome }}')">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <!-- Circle with a number instead of an icon -->
                                <div class="col-1 text-center">
                                    <div class="circle">
                                        <span class="number">{{$i}}</span> <!-- Replace '1' with the desired number -->
                                    </div>
                                </div>
                                <!-- Title and explanatory sentence in the middle -->
                                <div class="col-11 text-left">
                                    <h5 class="card-title" style="font-weight: 500">{{ $card->nome }}</h5>
                                    <p class="card-text" style="font-size:0.8rem;">{{ $card->descricao }}</p>
                                </div>


                            </div>
                        </div>
                    </button>
                </div>
            </div>
            @php
                $i=1+$i;
            @endphp
        @endforeach
        <style>
            .circle {
                width: 50px;
                /* Circle size */
                height: 50px;
                /* Circle size */
                border-radius: 50%;
                /* Makes the div circular */
                background-color: #f8f9fa;
                /* Circle color, change as needed */
                display: flex;
                justify-content: center;
                align-items: center;
                border: 1px solid #000;
                /* Circle border */
            }

            .number {
                font-size: 20px;
                /* Number size, change as needed */
                color: #000;
                /* Number color, change as needed */
            }

            .modal-body {
                max-height: 75vh;
                /* ou a altura que você desejar */
                overflow-y: auto;
                /* habilita a barra de rolagem vertical */
            }
        </style>

        <div class="modal fade {{ $showModal ? 'show' : '' }}"
            style="display: {{ $showModal ? 'block' : 'none' }}; overflow-x: hidden; overflow-y: auto;background-color: rgb(0,0,0,0.5);">
            <div class="modal-dialog" style="max-width: 85%; margin: 0; margin-left: auto;">
                <div class="modal-content" style="height: 100vh;background-color:#FEF9F2">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ $titulo }}</h5>
                        <button type="button" class="close"
                            wire:click="toggleModal('{{ $content }}','{{ $titulo }}')">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    @if ($content === 'InfoEstabelecimento')
                        @livewire('info-estabelecimento', ['estabelecimentoUui' => session('uuid')])
                    @elseif ($content === 'GrupoTrabalho')
                        @livewire('grupo-trabalho', ['estabelecimentoUui' => session('uuid')])
                    @elseif ($content === 'AnalisesAgua')
                        @livewire('analises-agua', ['establishmentUuid' => session('uuid')])
                    @elseif ($content === 'locali')
                        @livewire('file-upload', ['establishmentUuid' => session('uuid'), 'tipo' => 'locali'])
                    @elseif ($content === 'planta')
                        @livewire('file-upload', ['establishmentUuid' => session('uuid'), 'tipo' => 'planta'])
                    @else
                        Não foram encontradas informações!
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
