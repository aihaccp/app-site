<x-app-layout>
    <div class="container">
        <h5 style="margin-top:0.8rem;">Home / Espaços / {{ $area->designacao }}</h5>
        <a href="/configuracao/addequipamento/{{$area->uuid}}?uuid={{session('uuid')}}"  style="font-weight:400;background-color: black !important;border:0px;border-radius:0px;margin-top:2rem;" class="btn btn-primary">
            Adicionar Equipamento
        </a>


        <div class="mt-6">
            <h3>Equipamentos</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Configurar</th>
                        <th>QR code</th>
                        <!-- Adicione mais colunas conforme necessário -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($equipamentos as $equipamento)
                        <tr>
                            <td>{{ $equipamento->nome }}</td>
                            <td>
                                <a href="{{ route('equipamentos.edit', ['espaco' => $area->uuid, 'equi' => $equipamento->uuid]) }}?uuid={{ session('uuid') }}"
                                    class="btn btn-primary">Editar</a>


                            </td>
                            <td>
                                @livewire('qr-code-generator')

                            </td>



                            <!-- Adicione mais dados conforme necessário -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>




</x-app-layout>
