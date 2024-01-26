<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Organition;

class EstabelecimentosComponent extends Component
{
    public $estabelecimentos;
    public $uuid;

    public function mount($uuid)
    {
        $this->uuid = $uuid;
        $this->estabelecimentos = Organition::where('id',$this->uuid)->first()->companies;

    }

    public function redirectToDashboard($uuid)
    {
        session(['uuid' => $uuid]);
        return redirect()->to('/dashboard?uuid='.$uuid);
    }

    public function render()
    {
        return view('livewire.estabelecimentos-component');
    }
}
