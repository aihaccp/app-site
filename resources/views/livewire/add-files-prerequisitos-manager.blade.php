<div>
    <form wire:submit.prevent="uploadDocument">
        <input type="file" wire:model="documentFile">
        @error('documentFile') <span class="error">{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-success">Upload Documento</button>
    </form>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
</div>
