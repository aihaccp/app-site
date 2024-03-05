<div>
    <form wire:submit.prevent="addFolder">
        @csrf
        <div class="modal-body">
            <div class="form-group">
                <label for="nomePasta">Nome da Pasta</label>
                <input type="text" class="form-control" id="nomePasta" wire:model="nomePasta" required>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
