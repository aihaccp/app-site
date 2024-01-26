<div>
    <div class="d-flex">
        @if (!$buttonClicked)
            <div class="form-row">
                <div class="form-group col-md-6">
                    <input type="number" class="custom-input form-control" placeholder="Digite o NIPC" wire:model="nif"
                        required>
                </div>
                <div class="form-group col-md-6">
                    <label for="nipc"></label>

                    <button class="btn btn-primary"
                        style="font-weight:300;background-color: black !important;border:0px;border-radius:0px"
                        wire:click="consultarNif">Preencher dados</button>

                </div>
            </div>
        @endif
    </div>
    @if ($data && strcmp($data['result'], 'error') != 0)
        <div>
            <form method="POST" action="{{ route('registo-empresa') }}">
                @csrf
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" class="custom-input form-control" id="nome" name="nome"
                        value="{{ $data['records'][$nif]['title'] }}" placeholder="Digite seu nome" required>
                </div>
                <div class="form-group">
                    <label for="morada">Morada:</label>
                    <input type="text" class="custom-input form-control" id="morada" name="morada"
                        value="{{ $data['records'][$nif]['address'] }}" placeholder="Digite sua morada" required>
                </div>

                <div class="form-row"> <!-- Nova classe para agrupar os campos em uma linha -->
                    <div class="form-group col-md-6">
                        <label for="cp">Código Postal:</label>
                        <input type="text" class="custom-input form-control" id="cp" name="cp"
                            value="{{ $data['records'][$nif]['pc4'] }}-{{ $data['records'][$nif]['pc3'] }}"
                            placeholder="Digite o seu código de postal" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="localidade">Localidade</label>
                        <input type="text" class="custom-input form-control" id="localidade" name="localidade"
                            value="{{ $data['records'][$nif]['city'] }}" placeholder="Digite a localidade" required>
                    </div>
                </div>
                <div class="form-row"> <!-- Nova classe para agrupar os campos em uma linha -->
                    <div class="form-group col-md-6">
                        <label for="nipc">NIPC:</label>
                        <input type="text" class="custom-input form-control" id="nipc" name="nipc"
                            value="{{ $nif }}" placeholder="Digite o NIPC" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="nipc">Número de Estabelecimentos:</label>
                        <input type="number" class="custom-input form-control" id="numero_de_estabelecimentos"
                            name="n_stores" value="1" min="1" placeholder="Nº Estabelecimentos" required>

                    </div>

                </div>
                <div class="text-right">
                    <button type="submit" class="btn btn-primary"
                        style="font-weight:200;background-color: black !important;border:0px;">Seguinte</button>
                </div>
            </form>


        </div>
    @elseif ($data && strcmp($data['message'], 'No records found') == 0)
        <h6 style="color:#eead2d ;">Número de contribuinte da empresa não detetado, por favor tente novamente!</h6>
    @elseif ($data)
        <h6 style="color:brown;">Número de pedidos foram excedidos, por favor coloque os dados manualmente. Pedimos
            desculpa pelo incomodo!</h6>
        <form method="POST" action="{{ route('registo-empresa') }}">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="custom-input form-control" id="nome" name="nome"
                    placeholder="Digite seu nome">
            </div>
            <div class="form-group">
                <label for="morada">Morada:</label>
                <input type="text" class="custom-input form-control" id="morada" name="morada"
                    placeholder="Digite sua morada">
            </div>

            <div class="form-row"> <!-- Nova classe para agrupar os campos em uma linha -->
                <div class="form-group col-md-6">
                    <label for="cp">Código Postal:</label>
                    <input type="text" class="custom-input form-control" id="cp" name="cp"
                        placeholder="Digite o seu código de postal">
                </div>
                <div class="form-group col-md-6">
                    <label for="localidade">Localidade</label>
                    <input type="text" class="custom-input form-control" name="localidade" id="localidade"
                        placeholder="Digite a localidade">
                </div>
            </div>
            <div class="form-row"> <!-- Nova classe para agrupar os campos em uma linha -->
                <div class="form-group col-md-6">
                    <label for="nipc">NIPC:</label>
                    <input type="text" class="custom-input form-control" id="nipc" name="nipc"
                        placeholder="Digite o NIPC">
                </div>
                <input type="number" class="custom-input form-control" id="numero_de_estabelecimentos"
                    name="n_stores" value="1" min="1" placeholder="Nº Estabelecimentos" required>

            </div>

            <div class="text-right">
                <button type="submit" class="btn btn-primary"
                    style="font-weight:200;background-color: black !important;border:0px;">Seguinte</button>
            </div>
        </form>
    @endif

</div>
