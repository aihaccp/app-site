<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;

class StepsValidations extends Component
{
    public $currentStep;
    public function mount()
    {
        $uuid = session('uuid');
        $this->currentStep = Company::where('uuid', $uuid)->first()->validation_phasis_documents;
    }

    public function incrementStep()
    {
        if ($this->currentStep < 8) {
            $this->currentStep++;
            $this->saveCurrentStep();
        }
    }

    public function decrementStep()
    {
        if ($this->currentStep > 1) { // Adiciona uma verificação para garantir que não vá abaixo do passo inicial
            $this->currentStep--;
            $this->saveCurrentStep();
        }
    }
    public function finish(){
        $this->emit('goToNextStep1');

    }

    protected function saveCurrentStep()
    {
        $uuid = session('uuid');
        $company = Company::where('uuid', $uuid)->first();

        if ($company) {
            $company->validation_phasis_documents = $this->currentStep;
            $company->save();
        }
    }
    public function render()
    {
        return view('livewire.steps-validations');
    }
}
