<div>
    <button wire:click="generateQrCode" class="btn btn-primary">
        Gerar QR Code
    </button>

    @if($image_base64)
        <div>
            <img src="data:image/svg+xml;base64,{{ $image_base64 }}" alt="QR Code">
        </div>
    @endif
    <div>
        <button wire:click="generateQrCodeForDownload" class="btn btn-primary">
            Gerar QR Code para Download
        </button>

        @if ($downloadLink)
            <a href="{{ $downloadLink }}" download="qr-code.svg" class="btn btn-success">
                Baixar QR Code
            </a>
        @endif
    </div>

</div>
