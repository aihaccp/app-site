<x-app-layout>
    <style>
        .container {
            margin-top: 50px;
        }

        .table {
            text-align: center;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table-avatar img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }

        .table-avatar .avatar-initials {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #ccc;
            color: #fff;
            font-size: 20px;
        }

        .table-icons .btn {
            background-color: transparent;
            border: none;
        }

        .table-icons .btn i {
            font-size: 1.2rem;
            color: black;
        }
    </style>

    <div class="container">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2>Visualizar Funcionários</h2>

            @php
                $funcionariosCount = count($funcionarios);
                $maxFuncionarios = 10;
            @endphp
            @if ($funcionariosCount < $maxFuncionarios)
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="/register" class="btn btn-primary">Registar Utilizadores</a>
            @else
                <p style="color:brown">Já foi registado o número máximo de utilizadores. <br> Contacte o administrador
                </p>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Última vez ativo</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($funcionarios as $funcionario)
                        <tr>
                            <td class="table-avatar" style="text-align: center;">
                                @if ($funcionario->profile_photo_path)
                                    <img src="{{ asset('storage/' . $funcionario->profile_photo_path) }}"
                                        alt="{{ $funcionario->name }}" style="margin: auto;">
                                @else
                                    <div class="avatar-initials" style="margin: auto;">
                                        @php
                                            $names = explode(' ', $funcionario->name);
                                            $initials = '';
                                            foreach ($names as $name) {
                                                $initials .= strtoupper(substr($name, 0, 1));
                                            }
                                            echo $initials;
                                        @endphp
                                    </div>
                                @endif
                            </td>
                            <td>{{ $funcionario->name }}</td>
                            <td>{{ $funcionario->email }}</td>
                            <td>
                                @php
                                    $lastSession = DB::table('sessions')
                                        ->where('user_id', $funcionario->id)
                                        ->orderBy('last_activity', 'desc')
                                        ->value('last_activity');

                                    // Converter o timestamp para um formato de data/hora legível
                                    $lastSessionFormatted = \Carbon\Carbon::parse($lastSession)->format('d/m/Y H:i:s');

                                    echo $lastSessionFormatted;
                                @endphp
                            </td>
                            <td class="table-icons">
                                <!--<button class="btn btn-primary" title="Visualizar" data-bs-toggle="tooltip" data-bs-placement="top">
                                <i class="fas fa-eye"></i>
                            </button>-->
                                <button class="btn btn-info" title="Informações" data-bs-toggle="modal"
                                    data-bs-target="#logsModal{{ $funcionario->id }}">
                                    <i class="fas fa-info-circle"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <h2>Visualizar Registos</h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome do funcionário</th>
                        <th class="w-50">Ação</th>
                        <th>Data e hora do registo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $log)
                        <tr>
                            <td class="table-avatar" style="text-align: center;">
                                @if ($log->user->profile_photo_path)
                                    <img src="{{ asset('storage/' . $log->user->profile_photo_path) }}"
                                        alt="{{ $log->user->name }}" style="margin: auto;">
                                @else
                                    <div class="avatar-initials" style="margin: auto;">
                                        @php
                                            $names = explode(' ', $log->user->name);
                                            $initials = '';
                                            foreach ($names as $name) {
                                                $initials .= strtoupper(substr($name, 0, 1));
                                            }
                                            echo $initials;
                                        @endphp
                                    </div>
                                @endif
                            </td>
                            <td>{{ $log->user->name }}</td>
                            <td class="w-50">{{ $log->acao }}</td>
                            <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @foreach ($logs as $log)
            <style>
                .custom-modal {
                    border: none;
                }
            </style>
            <div class="modal fade" id="logsModal{{ $log->user->id }}" tabindex="-1"
                aria-labelledby="logsModal{{ $log->user->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header custom-modal">
                            <h5 class="modal-title" id="logsModal{{ $log->user->id }}Label">Logs de Registos do/a
                                {{ $log->user->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Ação</th>
                                        <th>Data e Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($logs as $log)
                                        <tr>
                                            <td>{{ $log->acao }}</td>
                                            <td>{{ $log->created_at }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer custom-modal">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.bundle.min.js"></script>
</x-app-layout>
