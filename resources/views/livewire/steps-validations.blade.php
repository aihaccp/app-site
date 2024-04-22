<div>
    @if ($currentStep == 1)
        @livewire('steps.step-introduction')
    @elseif ($currentStep == 2)
        @livewire('steps.step-one')
    @elseif ($currentStep == 3)
        @livewire('steps.step-two')
    @elseif ($currentStep == 4)
        @livewire('steps.step-three')
    @elseif ($currentStep == 5)
        @livewire('steps.step-four')
    @elseif ($currentStep == 6)
        @livewire('steps.step-five')
    @elseif ($currentStep == 7)
        @livewire('steps.step-six')
    @elseif ($currentStep == 8)
        @livewire('steps.step-seven')
    @endif

    <div class="mt-4">
        @if ($currentStep > 1)
            <button  style="font-weight:200;background-color: black !important;border:0px;" class="btn btn-primary" wire:click="decrementStep">Anterior</button>
        @endif
        @if ($currentStep < 8)

            <button  style="font-weight:200;background-color: black !important;border:0px;" class="btn btn-primary" wire:click="incrementStep">Próximo</button>
        @else
            <button  style="font-weight:200;background-color: black !important;border:0px;" class="btn btn-primary" wire:click="finish">Finalizar</button>
        @endif
    </div>
</div>
