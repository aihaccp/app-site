@extends('layouts.appregisto')

@section('robot-image', 'img/mascote_fala.png')

@section('right-section')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <style>
        .full-height2 {
            padding-top: 3.5rem;
        }
    </style>
    <div class="col-md-8 full-height2">
        <h2><b>🎉 Registo Concluído 🎉</b></h2>
        <p>A Equipa do AiHACCP vai verificar o teu registo e brevemente iremos entrar em contacto contigo. Se tiveres alguma
            dúvida, podes entrar em contacto através do nosso email: <a href="mailto:info@aihaccp.com">info@aihaccp.com</a>
        </p>

        <!-- Substitua o src pelo caminho real da sua imagem -->
        <img src="img/mascote_aihaccp.png" alt="Imagem Representativa" style="width:40%; height:auto; margin-top:20px;">
    </div>
@endsection
