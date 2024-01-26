<div>
    <div class="row">
        @foreach ($estabelecimentos as $index => $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow" wire:click="redirectToDashboard('{{ $item->uuid }}')">
                    <div class="card-body">
                        <div class="icon-circle mb-3">
                            <i class="fas fa-store fa-2x"></i>
                        </div>
                        <h5 class="card-title">
                            {{ $item->name ?? 'Estabelecimento ' . ($index + 1) }}
                        </h5>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
