<div>
    <div class="row pb-2" style="margin:0">
        <div class="input-group">
            <select class="form-control shadow" style="border:0px; font-size: 1.1rem;cursor:pointer;" aria-label="Selecionar Àrea" name="id_area" id="id_area" wire:model="areaId" required>
                <option selected disabled value="0">Selecionar Àrea</option>
                @foreach(json_decode($areas) as $area)
                    <option value="{{$area->id}}">{{ $area->designacao }}</option>
                @endforeach  
            </select>
        </div>
        @error('areaId')
            <span style="color:red; font-size:12px">{{ $message }}</span>
        @enderror
    </div>        
    <div class="row pb-2" style="margin:0">  
        <div class="input-group">
            <select class="form-control shadow" style="border:0px; font-size: 1.1rem;cursor:pointer;" aria-label="Selecionar Equipamento" name="id_equipamento" id="id_equipamento" wire:model="equipamentoId" required>
                <option selected disabled value="0">Selecionar Equipamento</option>
                @foreach(json_decode($equipamentos) as $equipamento)
                    <option value="{{$equipamento->id}}">{{ $equipamento->nome }}</option>
                @endforeach
            </select>
        </div>
        @error('equipamentoId')
            <span style="color:red; font-size:12px">{{ $message }}</span>
        @enderror
    </div>
    <div class="row pb-2" style="margin:0; margin-top:2%">
        <div class="input-group">
            <input class="form-control form-control-lg shadow py-3" type="number"
                style="border:0px; font-size: 1.1rem;" placeholder="Inserir Temperatura" name="temp"
                id="temp" wire:model="temperatura"/>
        </div>
        @error('temperatura')
            <span style="color:red; font-size:12px">{{ $message }}</span>
        @enderror
    </div>
    @if($equipamentoId != 0)
    <div class="row pb-2" style="margin:0">
        <div class="col-auto pr-0 d-flex align-items-center">
            <h5 class="m-0" >Temperatura mínima: </h5>
            <p class="ml-2 mb-0" > {{ $temp_min }}</p>
        </div>
    </div>
    <div class="row pb-2" style="margin:0">
        <div class="col-auto pr-0 d-flex align-items-center">
            <h5 class="m-0" >Temperatura máxima: </h5>
            <p class="ml-2 mb-0" > {{ $temp_max }}</p>
        </div>
    </div>
    @endif
</div>