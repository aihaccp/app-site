<!DOCTYPE html>
<html>

<head>
    <title>AiHACCP - Registo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/app.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .full-height {
            height: 100vh;
        }

        .bottom-logo {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .mobile-logo {
            display: none;
        }

        @media (max-width: 768px) {
            .mobile-logo {
                display: block;
            }

            .desktop-content {
                display: none;
            }
        }

        .scrollable-content {
            overflow-y: auto;
            overflow-x: hidden;
            max-height: 100vh;
        }

        .custom-select {
            border-right-width: 0px !important;
            border: 1.5px solid #858585;
            /* Cor da borda quando não está focado */
            outline: none;
            border-radius: 0px;
            /* Remove o outline padrão */
            transition: border-color 0.3s ease;
            /* Efeito de transição para a cor da borda */
        }
        .custom-input {
            border: 1.5px solid #858585;
            /* Cor da borda quando não está focado */
            outline: none;
            padding: 1rem;
            border-radius: 0px;
            /* Remove o outline padrão */
            transition: border-color 0.3s ease;
            /* Efeito de transição para a cor da borda */
        }
        .custom-select:focus {
            border: 1.5px solid#230c6d;
            border-radius: 0px;
            /* Cor da borda quando está focado */
            box-shadow: none;
            /* Remove o box-shadow padrão do navegador */
        }
        .custom-input:focus {
            border: 1.5px solid#230c6d;
            border-radius: 0px;
            padding: 1rem;
            /* Cor da borda quando está focado */
            box-shadow: none;
            /* Remove o box-shadow padrão do navegador */
        }
    </style>
    @livewireStyles
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Left Section with background image -->
            @include('layouts.partials.left-section')

            <!-- Right Section -->
            @yield('right-section')
        </div>
    </div>

    @livewireScripts
</body>

</html>
