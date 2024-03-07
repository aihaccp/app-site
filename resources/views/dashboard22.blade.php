<x-app-layout>
    <div class="container mt-5 bg-white p-4 border rounded" style="border-radius: 10px;">
        <!-- Seção de Cards -->
        <div class="row">
            <style>
                .card {
                    border: none;
                }

                .card-text {
                    color: #007bff;
                    font-size: 2.3rem;
                }

                .card-title {
                    font-size: 1.2rem;
                }

                .card-body i {
                    color: #5d7aab;
                }

                .icon-container {
                    min-width: 3rem;
                }
            </style>

            <!-- Card Total Equipe -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                        <div class="icon-container mb-2">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <p class="card-text mb-0">{{ $totalequipa }}</p>
                        <h5 class="card-title">Total Equipa</h5>
                    </div>
                </div>
            </div>

            <!-- Card Tarefas em Falta -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                        <div class="icon-container mb-2">
                            <i class="fas fa-exclamation-triangle fa-3x"></i>
                        </div>
                        <p class="card-text mb-0">{{ $alerta_count }}</p>
                        <h5 class="card-title">Tarefas em Falta</h5>
                    </div>
                </div>
            </div>

            <!-- Card Total de Equipamentos -->
            <div class="col-md-3">
                <div class="card shadow h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                        <div class="icon-container mb-2">
                            <i class="fas fa-tools fa-3x"></i>
                        </div>
                        <p class="card-text mb-0">{{ $equipamentos_count }}</p>
                        <h5 class="card-title">Total de Equipamentos</h5>
                    </div>
                </div>
            </div>

            <!-- Card Total de Espaços -->
            <div class="col-md-3">
                <a href="/configuracao/espacos?uuid={{session('uuid')}}">
                    <div class="card shadow h-100">
                        <div class="card-body text-center d-flex flex-column justify-content-center align-items-center">
                            <div class="icon-container mb-2">
                                <i class="fas fa-building fa-3x"></i>
                            </div>
                            <p class="card-text mb-0">{{ $espacos_count }}</p>
                            <h5 class="card-title">Total de Espaços</h5>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Seção de Tabelas -->
        <div class="row mt-4">
            <!-- Tabela de Tarefas Pendentes -->
            <div class="col-md-6">
                <h2 class="mb-3">Tarefas Pendentes</h2>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Tarefa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $id = 0; @endphp
                        @foreach ($alertas as $alerta)
                            @php $id += 1; @endphp
                            <tr>
                                <td>{{ $id }}</td>
                                <td>{{ $alerta->mensagem }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tabela de Logs de Registros -->
            <div class="col-md-6">
                <h2 class="mb-3">Logs de Registros</h2>
                <table class="table table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>ID</th>
                            <th>Funcionário</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $id = 0; @endphp
                        @foreach ($log_registos as $log_registo)
                            @php $id += 1; @endphp
                            <tr>
                                <td>{{ $id }}</td>
                                <td>{{ $log_registo->user->name }}</td>
                                <td>{{ $log_registo->acao }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

@if ($alertaAber)
    <script>
        $(document).ready(function() {
            $('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
    </script>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: rgb(250, 250, 250);border: 0rem;">
                <!-- Cabeçalho do modal -->
                <!-- Corpo do modal -->
                <div class="modal-body text-center d-flex flex-column align-items-center">
                    <img src="img/alerta_jaleca.png" alt="Verificação" style="width: 20rem" class="img-fluid mb-3">
                    <a href="modules/verificacoes/folders/abertura/adicionar?uuid={{ session('uuid') }}"
                        style="background-color: #5d7aab; border:0px; font-weight: 600"
                        class="btn btn-primary">Verificar</a>
                </div>
            </div>
        </div>
    </div>
@endif
@if ($alertaFecho)
    <script>
        $(document).ready(function() {
            $('#myModal').modal({
                backdrop: 'static',
                keyboard: false
            });
        });
    </script>
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: rgb(250, 250, 250);border: 0rem;">
                <!-- Cabeçalho do modal -->
                <!-- Corpo do modal -->
                <div class="modal-body text-center d-flex flex-column align-items-center">
                    <img src="img/notification.png" alt="Verificação" style="width: 20rem" class="img-fluid mb-3">
                    <a href="modules/verificacoes/folders/fecho/adicionar?uuid={{ session('uuid') }}"
                        style="background-color: #5d7aab; border:0px; font-weight: 600"
                        class="btn btn-primary">Verificar</a>
                </div>
            </div>
        </div>
    </div>
@endif
