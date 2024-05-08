<?php

namespace App\Http\Livewire;

use Livewire\Component;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;

class QrCodeGenerator extends Component
{
    public $qrCodeUrl;
    public $image_base64;
    public $downloadLink;

    public function generateQrCodeForDownload()
    {
        $data = 'https://www.example.com';
        $svg = QrCode::format('svg')->size(200)->generate($data);

        // Codificar em Base64 e preparar o link de download
        $base64Svg = base64_encode($svg);
        $this->downloadLink = 'data:image/svg+xml;base64,' . $base64Svg;
    }
    public function generateQrCode()
    {
        $data = 'https://www.example.com'; // O conteúdo do QR Code
        $svg = QrCode::format('svg')
            ->size(200) // Define o tamanho do QR Code
            ->generate($data);

        // Converte o SVG para Base64 para compatibilidade com o front-end
        $this->image_base64 = base64_encode($svg);
    }
    public function render()
    {
        return view('livewire.qr-code-generator');
    }
}
