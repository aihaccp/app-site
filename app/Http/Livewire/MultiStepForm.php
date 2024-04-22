<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class MultiStepForm extends Component
{
    protected $listeners = ['goToNextStep1' => 'goToNextStep'];

    public $currentStep;
    public function mount()
    {
        $uuid = session('uuid');
        $this->currentStep = Company::where('uuid', $uuid)->first()->plan_phasis;
    }
    public function render()
    {
        return view('livewire.multi-step-form');
    }

    public function goToNextStep()
    {

        if ($this->currentStep < 3) {
            $this->currentStep++;
            $this->saveCurrentStep();
        }
    }

    public function goToPreviousStep()
    {
        if ($this->currentStep > 1) { // Adiciona uma verificação para garantir que não vá abaixo do passo inicial
            $this->currentStep--;
            $this->saveCurrentStep();
        }
    }

    protected function saveCurrentStep()
    {
        $uuid = session('uuid');
        $company = Company::where('uuid', $uuid)->first();

        if ($company) {
            $company->plan_phasis = $this->currentStep;
            $company->save();
        }
    }

}
