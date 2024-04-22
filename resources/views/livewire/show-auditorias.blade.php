<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="container-fluid">
    <div class="row">
        @foreach ($auditorias as $auditoria)
            <div class="col-lg-4 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body d-flex flex-column">
                        <p style="font-size:0.8rem;">({{ $auditoria->frequencia->designacao }})</p>
                        <h5 class="card-title"><b>{{ $auditoria->name }}</b></h5>

                        <div class="mt-auto">
                            <a href="/auditorias/{{ $auditoria->uuid }}?uuid={{ $uuid }}"
                                class="btn btn-primary btn-block" style="background-color: black; border: 0;">Ver
                                Detalhes</a>
                            <a href="/auditorias/registo/{{ $auditoria->uuid }}?uuid={{ $uuid }}" class="btn btn-primary btn-block"
                                style="background-color: black; border: 0;">
                                Criar Registo</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <style>
        .btn-primary {
            transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            /* Um tom ligeiramente mais escuro do azul padrão do botão */
            transform: translateY(-2px);
            /* Levanta ligeiramente o botão para dar uma sensação de clique */
        }
    </style>
</div>
