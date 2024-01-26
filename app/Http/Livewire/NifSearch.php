<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class NifSearch extends Component
{
    public $buttonClicked = false;
    public $nif;
    public $data;
    public function consultarNif()
    {
        $url = "https://www.nif.pt/?json=1&q={$this->nif}&key=3bea3f0ce460d2cfb003eb2e84a13332";
        $response = Http::get($url);

        if ($response->successful()) {
            $data1 = $response->json();
            $this->buttonClicked = true;
            $this->data = $data1;
        } else {
            $this->buttonClicked = true;
            $this->data = $response->json();
        }
    }

    public function render()
    {
        return view('livewire.nif-search');
    }
}
