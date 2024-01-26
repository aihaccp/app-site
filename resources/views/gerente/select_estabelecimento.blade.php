<!DOCTYPE html>
<html>

<head>
    <title>Selecionar Estabelecimento:</title>
    <!-- Incluindo o CSS do Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="estilos.css">
    @livewireStyles
</head>

<body>
    <div class="container text-center mt-5">
        <h1 class="mb-5">Selecione o Estabelecimento:</h1>

        <!-- Card 1 -->
        @livewire('estabelecimentos-component', ['uuid' => $uuid])



    </div>

    <style>
        .card {
            transition: transform .2s;
            cursor: pointer;
            /* Animação ao passar o mouse */
        }

        .card:hover {
            transform: scale(1.05);
            /* Efeito de aumento ao passar o mouse */
        }

        .icon-circle {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            /* Cria um círculo */
            background-color: black;
            /* Cor de fundo do círculo */
            color: white;
            /* Cor do ícone */
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            /* Sombra para o círculo */
        }
    </style>
    <!-- Incluindo o JavaScript do Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    @livewireScripts
</body>

</html>
