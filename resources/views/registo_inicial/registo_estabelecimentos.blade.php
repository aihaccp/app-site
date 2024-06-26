@extends('layouts.appregisto')

@section('robot-image', 'img/mascote_2.png')

@section('right-section')
<div class="col-md-8 full-height" style="background-color: #FEF9F2; display: flex; flex-direction: column; padding-top:3.5rem">
    <h2><b>🏘️ Informação dos estabelecimentos</b></h2>
    <p>⏳ Tempo de registo: 10 minutos</p>
    <div class="scrollable-content">
        @livewire('establishment-manager', ['organizationId' => Request::input('organizacao')])
    </div>
</div>
@endsection
