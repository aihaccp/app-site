<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;
use App\Models\Organition;

class Estabelecimentos extends Component
{
    public $activePanel;
    public $organizationUuid = null;
    public $organizationId;
    public $companies = [];

    public function mount($organizationId = null)
    {
        $this->organizationUuid = request()->input('empresa');
        $this->organizationId = $organizationId ?? Organition::where('uuid', request()->input('empresa'))->first()->id;
        $this->loadCompanies();
    }

    public function loadCompanies()
    {
        if ($this->organizationId) {
            $this->companies = Organition::find($this->organizationId)->companies;
        }
    }

    public function goToNextPage1()
    {

        return redirect()->to('/registo-equipamentos?empresa='.$this->organizationUuid);
    }
    public function goToNextPage2()
    {
        return redirect()->to('/registo-pessoal?empresa='.$this->organizationUuid);
    }

    public function render()
    {
        return view('livewire.estabelecimentos');
    }
}
