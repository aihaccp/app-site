@extends('layouts.appregisto')

@section('robot-image', 'img/mascote_fala.png')

@section('right-section')
<div class="col-md-8 full-height" style="background-color: #FEF9F2; display: flex; flex-direction: column; padding-top:3.5rem">
    <h2><b>👋 Bem vindo/a </b></h2>
    <p>⏳ Tempo de registo: 10 minutos</p>
    <div class="scrollable-content">
        <livewire:nif-search />
    </div>
</div>
@endsection
