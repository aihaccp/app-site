<!DOCTYPE html>
<html>

<head>
    <title>Registar Gerente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/app.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .card {
            margin: 0 auto;
            max-width: 600px;
            background-color: #fff;
            padding: 20px;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            border: 0px;
        }

        .logo {
            text-align: right;
            padding-bottom: 1.3rem;
        }

        .logo img {
            height: 3.5rem;
        }

        .title {
            text-align: left;
            font-family: 'Poppins-Medium';
            margin-bottom: 1.1rem;
        }

        .input-group-prepend {
            position: relative;
        }

        .input-group-prepend i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #ccc;
            pointer-events: none;
        }

        .input-group-prepend i:hover {
            color: #333;
        }

        .password-toggle {
            position: relative;
        }

        .password-toggle input[type="password"] {
            padding-right: 35px;
        }
    </style>
    <script>
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            passwordInput.type = passwordInput.type === "password" ? "text" : "password";
        }

        function checkCapsLock(event) {
            var capsLockOn = event.getModifierState && event.getModifierState('CapsLock');
            var capsLockElement = document.getElementById("capslock");
            if (capsLockOn) {
                capsLockElement.style.display = 'block';
            } else {
                capsLockElement.style.display = 'none';
            }
        }
    </script>
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <!-- Foto à esquerda (ocultada em dispositivos móveis) -->
            <div class="col-lg-4 d-none d-lg-block shadow"
                style="background: url('img/register.jpg') no-repeat center center; background-size: cover; min-height: 100vh;border-radius:20px;
            overflow: hidden;">
                <!-- Deixe este espaço em branco, ele servirá apenas para mostrar a foto -->
            </div>

            <!-- Formulário à direita -->
            <div class="col-lg-8 d-flex flex-column align-items-start justify-content-center"
                style="padding-bottom:5rem;">
                <!-- Logo -->


                <!-- Mensagem de boas-vindas -->
                <h4 class="mb-4" style="font-weight:bold;">Registar o seu estabelecimento</h4>

                <!-- Formulário -->

                <form method="POST" action="/registo-user">
                    @csrf
                    <div class="form-group">
                        <label for="name">Nome:</label>
                        <input type="text" class="form-control" name="name" id="name"
                            placeholder="Digite seu email">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email"
                            placeholder="Digite seu email">
                    </div>
                    <input type="hidden" name="id_company" value="{{ request()->get('empresa') }}">
                    <div class="form-row">
                        <div class="form-group col-md-6 password-toggle">
                            <label for="senha">Senha:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" name="password" id="senha"
                                    placeholder="Digite sua senha" onkeydown="checkCapsLock(event)">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-eye" onclick="togglePasswordVisibility('senha')"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6 password-toggle">
                            <label for="confirmarSenha">Confirmar Senha:</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="confirmarSenha"
                                    placeholder="Confirme sua senha" onkeydown="checkCapsLock(event)">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fas fa-eye" onclick="togglePasswordVisibility('confirmarSenha')"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="capslock" style="display: none; color: red;">Caps Lock está ligado.</div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary"
                            style="font-weight:200;background-color: black !important;border:0px;">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>

</html>
