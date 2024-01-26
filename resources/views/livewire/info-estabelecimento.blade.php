<div>
    <div class="modal-body">
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" wire:model.defer="companie.name" class="custom-input form-control">
        </div>
        <div class="form-group">
            <label>Morada:</label>
            <input type="text" wire:model.defer="companie.morada" class="custom-input form-control">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Código Postal:</label>
                <input type="text" wire:model.defer="companie.cp" class="custom-input form-control">
            </div>
            <div class="form-group col-md-6">
                <label>Localidade:</label>
                <input type="text" wire:model.defer="companie.localidade" class="custom-input form-control">
            </div>
        </div>
        <div class="form-group">
            <select id="cae-select" wire:model.defer="companie.cae" class="custom-input" style="width:100%" required>
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
            <input type="number" wire:model.defer="companie.n_users" class="custom-input form-control">
        </div>
    </div>
    <div class="modal-footer">
        <button style="font-weight:40 0;background-color: black !important;border:0px;border-radius:0px" wire:click=""
            class="btn btn-primary">Cancelar</button>
        <button style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
            wire:click="saveCompany()" class="btn btn-primary">Guardar</button>
    </div>


    <script>
        window.livewire.on('refreshPage', function() {
            window.location.reload();
        });
    </script>
</div>
