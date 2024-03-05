<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="folder">Pasta</label>
            <select class="form-control" id="folder" wire:model="selectedFolder">
                <option value="">Selecione uma Pasta</option>
                @foreach ($folders as $folder)
                    <option value="{{ $folder->id }}">{{ $folder->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="file">Arquivo</label>
            <input type="file" class="form-control" id="file" wire:model="file">
            @error('file') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Adicionar Arquivo</button>
    </form>
</div>
