<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    @livewireScripts
</head>

<body class="font-sans antialiased">
    <x-banner />
    <style>
        .dropdown-item.active,
        .dropdown-item:active {
            color: #fff;
            text-decoration: none;
            background-color: black;
        }

        .sidebar-fixed {
            position: fixed;
            height: 100vh;
            /* para permitir rolagem se o conteúdo for muito longo */
        }

        .content-main {
            overflow-y: auto;
            height: 100vh;
        }

        .nav-item {
            margin-bottom: 1rem;
            background-color: #f8f9fa;
            width: 100%;
            color: black;
            padding-left: 1rem;
            padding-right: 1rem;
            border-radius: 5px;
            font-weight: 500;
        }

        .nav-link:hover {
            color: #f8f9fa;
        }

        .nav-item:hover {
            background-color: black;
            width: 100%;
            color: white;
            padding-left: 1rem;
            padding-right: 1rem;
            border-radius: 5px;
            font-weight: 500;
        }
    </style>
    @php
        use App\Models\Company;
        use Illuminate\Support\Facades\Session;

        $company_ph = null;

        if (Session::has('uuid')) {
            $uuid = Session::get('uuid');
            $company_ph = Company::where('uuid', $uuid)->first()->plan_phasis;

        }
    @endphp
    <div class="min-h-screen bg-gray-100" style="background-color:#FEF9F2">
        <div class="container-fluid">
            <div class="row flex-nowrap">
                <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 sidebar-fixed"
                    style="color: white; text-align: left; position: relative;">
                    <div
                        class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                        <a href="/"
                            class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                            <span class="fs-5 d-none d-sm-inline"><img style="height:4rem;"
                                    src="{{ asset('img/logotipoAihaccp.png') }}" alt=""></span>
                        </a>
                        <ul style="width: -webkit-fill-available;"
                            class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start"
                            id="menu">
                            <li class="nav-item shadow">
                                <a href="{{ route('dashboard', ['uuid' => session('uuid')]) }}"
                                    class="nav-link align-middle px-0">
                                    <i class="fas fa-user"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                                </a>
                            </li>

                            <li class="nav-item shadow">
                                <a href="{{ route('haccp_plan', ['uuid' => session('uuid')]) }}"
                                    class="nav-link px-0 align-middle">
                                    <i class="fa fa-receipt"></i> <span class="ms-1 d-none d-sm-inline">SGSA</span></a>
                            </li>


                            <li class="nav-item shadow">
                                <a href="/modules/registos?uuid={{ session('uuid') }}" @if($company_ph <=3) style="pointer-events: none;opacity: 0.3;" @endif
                                    class="nav-link px-0 align-middle">
                                    <i class="fas fa-chart-line"></i> <span
                                        class="ms-1 d-none d-sm-inline">Monitorização</span> </a>
                            </li>
                            <li class="nav-item shadow">
                                <a href="/auditorias?uuid={{ session('uuid') }}" @if($company_ph <=3) style="pointer-events: none;opacity: 0.3;" @endif
                                    class="nav-link px-0 align-middle">
                                    <i class="fa fa-tasks"></i> <span class="ms-1 d-none d-sm-inline">Auditoria</span>
                                </a>
                            </li>
                            <li class="nav-item shadow">
                                <a href="{{ route('gerente-show', ['uuid' => session('uuid')]) }}"
                                    class="nav-link px-0 align-middle">
                                    <i class="fa fa-users"></i> <span class="ms-1 d-none d-sm-inline">Equipa</span>
                                </a>
                            </li>
                            <li class="nav-item shadow">
                                <a href="/modules/documentos?uuid={{ session('uuid') }}"
                                    class="nav-link px-0 align-middle">
                                    <i class="fa fa-folder-open"></i> <span
                                        class="ms-1 d-none d-sm-inline">Documentos</span> </a>
                            </li>
                            <li class="nav-item shadow">
                                <a href="/configuracao?uuid={{ session('uuid') }}" @if($company_ph <=3) style="pointer-events: none;opacity: 0.3;" @endif
                                    class="nav-link px-0 align-middle">
                                    <i class="fa fa-sliders-h" style="color:black"></i> <span
                                        class="ms-1 d-none d-sm-inline">Configuração</span> </a>
                            </li>
                            <li class="nav-item shadow">
                                <a href="/chat?uuid={{ session('uuid') }}" class="nav-link px-0 align-middle"
                                    style="display: flex;align-items: center;">
                                    <i class="fs-4 bi-people"><img src="{{ asset('img/mascote_aihaccp.png') }}"
                                            style="height:1.5rem" alt="Jaleca"></i> <span
                                        class="ms-1 d-none d-sm-inline">Jaleca</span>
                                </a>
                            </li>
                        </ul>
                        <hr>

                    </div>
                </div>
                <main role="main" class="col py-3 content-main ">
                    @livewire('navigation-menu')

                    <!-- Page Heading -->
                    @if (isset($header))
                        <header class="bg-white shadow">
                            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                                {{ $header }}
                            </div>
                        </header>
                    @endif
                    <!-- Seu conteúdo aqui -->
                    {{ $slot }}
                </main>
            </div>
        </div>



        <!-- Conteúdo principal -->



    </div>

    @stack('modals')
</body>

</html>
