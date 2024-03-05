<x-app-layout>
    <div class="container">
        <h5 style="margin-top:0.8rem;">Home / Espaços / {{ $area->designacao }}</h5>


        <div class="container">

            @livewire('edit-equipamento', ['equipamento' => $equipamento])

        </div>


    </div>




</x-app-layout>
