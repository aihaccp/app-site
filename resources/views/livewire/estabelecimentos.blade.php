<div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .accordion-item {
            margin-bottom: 1rem;
        }

        label {
            margin-bottom: 0rem;
            font-size: 0.8rem;
        }

        .custom-accordion-header {
            background-color: #ffffff;
            border: 1px solid #d3d3d3;
            /* Espaço extra na parte inferior de cada cabeçalho */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .custom-accordion-button {
            color: #000000;
            font-size: 1.1rem;
            font-weight: 500;
            text-align: left;
            padding: 1rem 1.5rem;
            background-color: transparent;
            border: none;
            box-shadow: none;
            width: 100%;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .custom-accordion-button:focus {
            outline: none;
            background-color: #e2e0fc;
        }

        .custom-accordion-button::after {
            display: none;
        }

        .accordion-body {
            background-color: #ffffff;
            padding: 1rem;
            border-top: none;
        }
    </style>

    <div id="accordionId">
        @foreach ($companies as $index => $establishment)
            <div class="accordion-item">
                <h2 class="accordion-header custom-accordion-header" id="heading{{ $establishment->id }}">
                    <button class="custom-accordion-button d-flex justify-content-between align-items-center"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $establishment->id }}"
                        aria-expanded="true" @if ($index !== 0 && $establishment->status === 1) disabled @endif>

                        <h4 class="mb-0">🍴 {{ $establishment->name ?? 'Estabelecimento ' . ($index + 1) }}</h4>


                    </button>
                </h2>
                <div id="collapse{{ $establishment->id }}" class="accordion-collapse collapse "
                    data-bs-parent="#accordionId">
                    <div class="accordion-body">
                        {{-- Seu formulário de edição aqui --}}
                        @php
                            $path = $_SERVER['REQUEST_URI']; // Isso pegará 'registo-equipamentos' ou 'registo-espacos'

                            // Análise do URL para obter apenas a parte antes do '?'
                            $tipo = parse_url($path, PHP_URL_PATH);
                        @endphp
                        @if ($tipo === '/registo-equipamentos')
                            {{-- Carregar o componente Livewire para equipamentos --}}
                            @livewire('equipamentos-manager', ['establishmentId' => $establishment->id])

                        @elseif ($tipo === '/registo-espacos')
                            {{-- Carregar o componente Livewire para espaços --}}
                            @livewire('espaco-manager', ['establishmentId' => $establishment->id])
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if ($tipo === '/registo-equipamentos')
    {{-- Carregar o componente Livewire para equipamentos --}}
    <div style="text-align: right;margin-top:2rem;margin-bottom:2rem;">
        <button style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
            wire:click="goToNextPage2" class="btn btn-primary">Seguinte</button>
    </div>

@elseif ($tipo === '/registo-espacos')
    {{-- Carregar o componente Livewire para espaços --}}
    <div style="text-align: right;margin-top:2rem;margin-bottom:2rem;">
        <button style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
            wire:click="goToNextPage1" class="btn btn-primary">Seguinte</button>
    </div>
@endif

</div>
