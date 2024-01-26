<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erro 403 - Acesso Negado</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .error-container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .error-content {
            text-align: center;
            display: flex;
            align-items: center;
            flex-direction: column;
        }

        .error-icon {
            font-size: 8rem;
            margin-bottom: 20px;
            color: #5573a5;
        }

        .error-title {
            font-size: 36px;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .error-message {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn-container {
            display: flex;
        }

        .btn-container .btn {
            margin-right: 10px;
            background-color: #5573a5;
            border: none;
        }

        .btn-container .btn i {
            color: white;
        }

        @media (max-width: 767px) {
            .error-content {
                flex-direction: row;
                flex-wrap: wrap;
                justify-content: center;
            }

            .error-content > * {
                margin: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-content">
            <i class="fas fa-lock error-icon"></i>
            <h1 class="error-title">Acesso Negado</h1>
            <p class="error-message">Peço desculpa, mas não tem permissão para aceder a esta página. <br> Contacte o administrador!</p>
            <div class="btn-container">
                <a href="#" onclick="window.history.back();" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Voltar Atrás
                </a>
                <a href="/" class="btn btn-primary">Página Inicial</a>
            </div>
        </div>
    </div>
</body>
</html>
