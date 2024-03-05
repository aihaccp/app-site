
<x-app-layout>
    <div class="container">
        <h5 style="margin-top:0.8rem;">Home / Espaços / {{ $area->designacao }}</h5>


        <div class="mt-6">
            @livewire('add-equipamento', ['id_area' => $area->uuid])
        </div>


    </div>




</x-app-layout>
