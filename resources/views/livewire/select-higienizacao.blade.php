<div>
    <div class="row pb-2" style="margin:0">
        <div class="input-group">
            <select class="form-control shadow" style="border:0px; font-size: 1.1rem;cursor:pointer;" aria-label="Selecionar Àrea" name="id_area" id="id_area" wire:model="areaId" required>
                <option selected disabled value="0">Selecionar Àrea</option>
                @foreach(json_decode($areas) as $area)
                    <option value="{{ $area->id }}">{{ $area->designacao }}</option>
                @endforeach
            </select>
        </div>
        @error('areaId')
            <span style="color:red; font-size:12px">{{ $message }}</span>
        @enderror
    </div>
    <div class="row pb-2" style="margin:0">
        <div class="input-group">
            <select class="form-control shadow" style="border:0px; font-size: 1.1rem;cursor:pointer;"aria-label="Selecionar Item a Higienizar" name="id_item" id="id_item" wire:model="itemId" required>
                <option selected disabled value="0">Selecionar Item a Higienizar</option>
                    @foreach(json_decode($itens) as $item)
                        <option value="{{$item->id}}">{{ $item->nome }}</option>
                    @endforeach
            </select>
        </div>
        @error('itemId')
            <span style="color:red; font-size:12px">{{ $message }}</span>
        @enderror
    </div>

    @if($produtoId != 0)
    <div class="row pt-2 pb-1 d-flex align-items-center">
        <div class="col-auto pr-0 d-flex align-items-center">
            <h5 class="m-0" >Frequência: </h5>
            <p class="ml-2 mb-0" > {{ $frequencia }} </p>
            <input type="hidden" name="id_acao_frequencia" value="{{$id_acao_frequencia}}">
        </div>
    </div>
    @endif

    @if($itemId != 0)
    <div class="row pb-2" style="margin:0">
        <div class="input-group">
            <select class="form-control shadow" style="border:0px; font-size: 1.1rem;cursor:pointer;"aria-label="Produto Quimico a utilizar" name="id_produto" wire:model="produtoId" required>
                <option selected disabled value="0">Produto Quimico a utilizar</option>
                @foreach(json_decode($produtos) as $produto)
                    <option value="{{$produto->id}}">{{ $produto->designacao }}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif
</div>
