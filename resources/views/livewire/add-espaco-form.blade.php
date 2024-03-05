<form wire:submit.prevent="addEspaco">
    <div class="modal-body">
        <div class="form-group">
            <label for="nomeEspaco">Nome do Espaço</label>
            <input type="text" class="form-control" id="nomeEspaco" placeholder="Nome do Espaço" wire:model="designacao">
            @error('designacao') <span class="error text-danger">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>
