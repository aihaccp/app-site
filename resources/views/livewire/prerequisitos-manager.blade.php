<div class="container mt-4" style="padding:2rem;">
    <div class="row">
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label">Nome do Folder</label>
                    <input type="text" class="form-control" id="name" wire:model="name" placeholder="Nome do Folder">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror

                </div>

                <div class="mb-3">
                    <label for="icon" class="form-label">Ícone</label>
                    <input type="text" class="form-control" id="icon" wire:model="icon" placeholder="Ícone">
                <a target="_blank" style="font-size: 0.6rem;" href="https://fontawesome.com/search?o=r&m=free">https://fontawesome.com/search?o=r&m=free</a>
                @error('icon') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

                <div class="mb-3">
                    <label for="disabled" class="form-label">Status</label>
                    <select class="form-select" id="disabled" wire:model="disabled">
                        <option value="1" selected>Ativo</option>
                        <option value="0">Desativo</option>
                    </select>
                    @error('disabled') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button type="button" class="btn btn-primary" style="background-color: black; border: 0;" wire:click="addFolder">Adicionar Folder</button>
            </form>
        </div>
        <div class="col-md-6">
            <h4>Folders existentes</h4>
            <div class="list-group">
                @foreach($folders as $folder)
                    <a href="#" class="list-group-item list-group-item-action d-flex align-items-center">
                        <i class="{{ $folder->icon }}" style="margin-right: 1rem"></i>
                        <span class="ms-2">{{ $folder->name }}</span>
                    </a>
                @endforeach
            </div>

        </div>
    </div>
</div>
