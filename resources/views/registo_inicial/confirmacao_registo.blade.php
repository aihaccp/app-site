@extends('layouts.appregisto')

@section('robot-image', 'img/mascote_fala.png')

@section('right-section')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<style>
    .email-logos {
            display: flex;
            justify-content: left;
            align-items: center;
            gap: 20px;
            margin-top: 20px;
        }

        .email-logo {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: white;
            border-radius: 50%; /* Cria um círculo */
            width: 60px; /* Largura do círculo */
            height: 60px; /* Altura do círculo */
        }

        .email-logo img {
            width: 80%; /* Redimensiona a imagem para caber dentro do círculo */
            height: auto;
        }
</style>
<div class="col-md-8 full-height" style="background-color: #FEF9F2; display: flex; flex-direction: column; padding-top:3.5rem">
    <h2><b>📥 Registo Concluído</b></h2>
    <p>Para continuar os passos, verifica o teu email. Se não encontrares o email, verifica na pasta de spam.</p>
    <p><b>Acesso rápido ao email:</b>

    <div class="email-logos">
        <a href="https://mail.google.com/" target="_blank" class="email-logo">
            <img src="img/flag/gmail.png" alt="Gmail"> <!-- Substitua com o caminho real da imagem -->
        </a>
        <a href="https://outlook.live.com/" target="_blank" class="email-logo">
            <img src="img/flag/outlook.png" alt="Outlook"> <!-- Substitua com o caminho real da imagem -->
        </a>
    </div>
</div>
@endsection
