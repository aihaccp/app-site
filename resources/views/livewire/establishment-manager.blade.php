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

                        @if ($index === 0)
                            <span style="color:white;"
                                class="badge {{ $this->isEstablishmentFilled($establishment) ? 'bg-success' : 'bg-warning text-dark' }}">
                                {{ $this->isEstablishmentFilled($establishment) ? 'Preenchido' : 'Por preencher' }}
                            </span>
                        @else
                            <div class="form-check form-switch">
                                @if (!$this->isEstablishmentFilled($establishment))
                                    <input class="form-check-input" type="checkbox" role="switch"
                                        id="statusSwitch{{ $establishment->id }}"
                                        wire:click="toggleStatus({{ $establishment->id }})"
                                        @if ($establishment->status === 1) checked @endif>
                                    <label class="form-check-label" for="statusSwitch{{ $establishment->id }}">
                                        @if ($establishment->status === 1)
                                        Preencher agora
                                        @else
                                        Mais tarde

                                        @endif
                                    </label>
                                @endif
                                <span style="color:white;"
                                    class="badge {{ $this->isEstablishmentFilled($establishment) ? 'bg-success' : 'bg-warning text-dark' }}">
                                    {{ $this->isEstablishmentFilled($establishment) ? 'Preenchido' : 'Por preencher' }}
                                </span>
                            </div>
                        @endif

                    </button>
                </h2>
                <div id="collapse{{ $establishment->id }}" class="accordion-collapse collapse "
                    data-bs-parent="#accordionId">
                    <div class="accordion-body">
                        {{-- Seu formulário de edição aqui --}}
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" wire:model.defer="companies.{{ $index }}.name"
                                class="custom-input form-control">
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="sameAddressCheckbox{{ $index }}"
                                wire:change="copyAddress({{ $index }})">
                            <label class="form-check-label" for="sameAddressCheckbox{{ $index }}">Dados da
                                morada iguais</label>
                        </div>
                        <div class="form-group">
                            <label>Morada:</label>
                            <input type="text" wire:model.defer="companies.{{ $index }}.morada"
                                class="custom-input form-control">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Código Postal:</label>
                                <input type="text" wire:model.defer="companies.{{ $index }}.cp"
                                    class="custom-input form-control">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Localidade:</label>
                                <input type="text" wire:model.defer="companies.{{ $index }}.localidade"
                                    class="custom-input form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <select id="cae-select" wire:model.defer="companies.{{ $index }}.cae"
                                class="custom-input" style="width:100%" required>
                                <option>Seleciona a CAE que se associa ao estabelecimento:</option>
                                <optgroup label="Hotelaria">
                                    <option value="55111">55111 - Hotéis com restaurante</option>
                                    <option value="55112">55112 - Hotéis sem restaurante</option>
                                    <option value="55113">55113 - Estalagens com restaurante</option>
                                    <option value="55114">55114 - Estalagens sem restaurante</option>
                                    <option value="55115">55115 - Pousadas com restaurante</option>
                                    <option value="55116">55116 - Pousadas sem restaurante</option>
                                    <option value="55117">55117 - Motéis com restaurante</option>
                                    <option value="55118">55118 - Motéis sem restaurante</option>
                                    <option value="55119">55119 - Pensões com restaurante</option>
                                    <option value="55120">55120 - Pensões sem restaurante</option>
                                    <option value="55121">55121 - Hotéis-Apartamentos com restaurante</option>
                                    <option value="55122">55122 - Hotéis-Apartamentos sem restaurante</option>
                                    <option value="55201">55201 - Alojamento mobilado para turistas</option>
                                    <option value="55202">55202 - Turismo no espaço rural</option>
                                    <option value="55203">55203 - Colónias e campos de férias</option>
                                    <option value="55204">55204 - Outros locais de alojamento de curta duração</option>
                                </optgroup>

                                <optgroup label="Restauração">
                                    <option value="56101">56101 - Restaurantes tipo tradicional</option>
                                    <option value="56102">56102 - Restaurantes com lugares ao balcão</option>
                                    <option value="56103">56103 - Restaurantes sem serviço de mesa</option>
                                    <option value="56104">56104 - Restaurantes típicos</option>
                                    <option value="56105">56105 - Restaurantes com espaço de dança</option>
                                    <option value="56106">56106 - Confeção de refeições prontas a levar para casa
                                        (take-away)</option>
                                    <option value="56107">56107 - Restaurantes, n.e. (inclui atividades de restauração
                                        em
                                        meios móveis)</option>
                                    <option value="56210">56210 - Fornecimento de refeições para eventos</option>
                                    <option value="56290">56290 - Outras atividades de serviço de refeições</option>
                                    <option value="56301">56301 - Cafés</option>
                                    <option value="56302">56302 - Bares</option>
                                    <option value="56303">56303 - Pastelarias e casas de chá</option>
                                    <option value="56304">56304 - Outros estabelecimentos de bebidas sem espetáculo
                                    </option>
                                    <option value="56305">56305 - Estabelecimentos de bebidas com espaço de dança
                                    </option>
                                </optgroup>

                                <optgroup label="Retalho">
                                    <option value="47111">47111 - Comércio a retalho em supermercados e hipermercados
                                    </option>
                                    <option value="47112">47112 - Comércio a retalho em outros estabelecimentos não
                                        especializados, com predominância de produtos alimentares, bebidas ou tabaco
                                    </option>
                                    <option value="47191">47191 - Comércio a retalho em estabelecimentos não
                                        especializados, sem predominância de produtos alimentares, bebidas ou tabaco
                                    </option>
                                    <option value="47210">47210 - Comércio a retalho de frutas e produtos hortícolas,
                                        em
                                        estabelecimentos especializados</option>
                                    <option value="47220">47220 - Comércio a retalho de carne e produtos à base de
                                        carne,
                                        em estabelecimentos especializados</option>
                                    <option value="47230">47230 - Comércio a retalho de peixe, crustáceos e moluscos,
                                        em
                                        estabelecimentos especializados</option>
                                    <option value="47240">47240 - Comércio a retalho de pão, produtos de pastelaria e
                                        de
                                        confeitaria, em estabelecimentos especializados</option>
                                    <option value="47250">47250 - Comércio a retalho de bebidas, em estabelecimentos
                                        especializados</option>
                                    <option value="47260">47260 - Comércio a retalho de produtos de tabaco, em
                                        estabelecimentos especializados</option>
                                    <option value="47291">47291 - Comércio a retalho de leite e de derivados, em
                                        estabelecimentos especializados</option>
                                    <option value="47292">47292 - Comércio a retalho de açúcar, chocolate e produtos de
                                        confeitaria, em estabelecimentos especializados</option>
                                    <option value="47293">47293 - Comércio a retalho de produtos alimentares, naturais
                                        e
                                        dietéticos, em estabelecimentos especializados</option>
                                    <option value="47294">47294 - Comércio a retalho de outros produtos alimentares,
                                        n.e.,
                                        em estabelecimentos especializados</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Número de Funcionários:</label>
                            <input type="number" wire:model.defer="companies.{{ $index }}.n_users"
                                class="custom-input form-control">
                        </div>

                        <div class="form-group">
                            <button
                                style="width: 100%;font-weight:400;background-color: black !important;border:0px;border-radius:0px"
                                wire:click="saveCompany({{ $index }})" class="btn btn-primary">Salvar</button>
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div style="text-align: right;margin-top:2rem;margin-bottom:2rem;">
        <button style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
            wire:click="goToNextPage" class="btn btn-primary">Seguinte</button>
    </div>
</div>
