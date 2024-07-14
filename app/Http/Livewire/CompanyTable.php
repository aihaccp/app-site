<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;

class CompanyTable extends Component
{
    public $companies;
    public $selectedCompany = null;
    public $status;

    protected $rules = [
        'status' => 'required|integer|in:1,2,3,4',
    ];

    public function mount()
    {
        $this->companies = Company::all();
    }

    public function selectCompany($companyId)
    {
        $this->selectedCompany = Company::find($companyId);
        $this->status = $this->selectedCompany ? $this->selectedCompany->plan_phasis : null;
        
    }

    public function updateStatus()
    {
        $this->validate();

        if ($this->selectedCompany) {
            $this->selectedCompany->update(['plan_phasis' => $this->status]);
            $this->companies = Company::all(); // refresh the companies list
            $this->reset('selectedCompany', 'status');
            $this->dispatchBrowserEvent('close-modal');
        }
    }

    public function render()
    {
        return view('livewire.company-table');
    }
}
