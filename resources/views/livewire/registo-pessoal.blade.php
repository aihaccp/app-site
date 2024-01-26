<div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Para Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Para Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>


    {{-- Seu formulário de edição aqui --}}
    <div class="form-group">
        <label>Nome:</label>
        <input type="text" wire:model.defer="pessoal.name" required class="form-control @error('pessoal.name') is-invalid @enderror custom-input" >
        @error('pessoal.name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    </div>


    <div class="form-row">
        <div class="form-group col-md-6">
            <label>Email:</label>
            <input type="email" wire:model.defer="pessoal.email" required class=" @error('pessoal.email') is-invalid @enderror scustom-input form-control">
            @error('pessoal.email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="form-group col-md-6">
            <label>Número de Telemóvel:</label>
            <div class="input-group">
                <!-- Ajuste o tamanho do select para ocupar 1/3 do espaço disponível (col-4) -->
                <div class="col-4 p-0">
                    <select class="custom-select form-control select2" wire:model.defer="pessoal.phone_prefix">
                        <option selected value="+351" data-flag="pt">PT (+351)</option>
                        <option value="+34" data-flag="es">ES (+34)</option>
                        <option value="+44" data-flag="gb">UK (+44)</option>
                        <option value="+1" data-flag="us">USA (+1)</option>
                    </select>
                </div>
                <!-- Ajuste o tamanho do input para ocupar 2/3 do espaço disponível (col-8) -->
                <div class="col-8 p-0">
                    <input type="number" maxlength="10" required
                        oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                        wire:model.defer="pessoal.n_phone" class="custom-input form-control @error('pessoal.n_phone') is-invalid @enderror ">
                        @error('pessoal.n_phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    </div>
            </div>

        </div>
        <div class="form-group col-md-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input @error('pessoal.aceitaTermos') is-invalid @enderror" id="termosCondicoes" required
                    wire:model.defer="pessoal.aceitaTermos">
                <label class="custom-control-label" for="termosCondicoes"><span style="color:red">*</span>Li e aceito os
                    <a href="https://aihaccp.com/termos-condicoes">Termos e Condições</a></label> @error('pessoal.aceitaTermos')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
        </div>
        <div class="form-group col-md-12">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="newsletterSubscricao"
                    wire:model.defer="pessoal.subscreverNewsletter">
                <label class="custom-control-label" for="newsletterSubscricao">Aceito receber newsletters e informações
                    privilegiadas</label>
            </div>
        </div>



    </div>


    <div style="text-align: right;margin-top:2rem;margin-bottom:2rem;">
        <button style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
            wire:click="save" class="btn btn-primary">Seguinte</button>
    </div>
</div>
