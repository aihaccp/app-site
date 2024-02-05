<x-app-layout>
    <div class="container mt-5" style="background-color: white !important; padding:1rem;border-radius:10px;">
        <!-- Seção de Cards -->
        <div class="row">
            <style>
                .card {
                    border: none;
                }

                .card-text {
                    color: #007bff;
                    /* Cor do número */
                    font-size: 2.3rem;
                    /* Ajuste o tamanho do número */
                }

                .card-title {
                    font-size: 1.2rem;
                    /* Tamanho do título do card */
                }

                .card-body i {
                    color: #5d7aab;
                    /* Cor do ícone */
                }

                .icon-container {
                    min-width: 3rem;
                    /* Ajuste a largura mínima do ícone */
                }
            </style>

            <!-- Card 1 -->
            <div class="col-sm-3">
                <div class="card shadow">
                    <div class="card-body d-flex align-items-center">
                        <!-- Ícone à Esquerda -->
                        <div class="icon-container text-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>

                        <!-- Número e Texto à Direita -->
                        <div class="text-center flex-grow-1">
                            <p class="card-text mb-0">{{$totalequipa}}</p>
                            <h5 class="card-title">Total Equipa</h5>
                        </div>
                    </div>
                </div>
            </div>




            <!-- Card 2 -->
            <div class="col-sm-3">
                <div class="card shadow">
                    <div class="card-body d-flex align-items-center">
                        <!-- Ícone à Esquerda -->
                        <div class="icon-container text-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>

                        <!-- Número e Texto à Direita -->
                        <div class="text-center flex-grow-1">
                            <p class="card-text mb-0">{{$alerta_count}}</p>
                            <h5 class="card-title">Tarefas em falta</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-sm-3">
                <div class="card shadow">
                    <div class="card-body d-flex align-items-center">
                        <!-- Ícone à Esquerda -->
                        <div class="icon-container text-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>

                        <!-- Número e Texto à Direita -->
                        <div class="text-center flex-grow-1">
                            <p class="card-text mb-0">{{$equipamentos_count}}</p>
                            <h5 class="card-title">Total de Equipamentos</h5>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card shadow">
                    <div class="card-body d-flex align-items-center">
                        <!-- Ícone à Esquerda -->
                        <div class="icon-container text-center">
                            <i class="fas fa-users fa-3x"></i>
                        </div>

                        <!-- Número e Texto à Direita -->
                        <div class="text-center flex-grow-1">
                            <p class="card-text mb-0">{{$espacos_count}}</p>
                            <h5 class="card-title">Total de espacos</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Seção de Tabelas -->
        <div class="row mt-4">
            <!-- Tabela de Tarefas Pendentes -->
            <div class="col-md-6">
                <h2>Tarefas Pendentes</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tarefa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id =0;
                        @endphp
                        @foreach($alertas as $alerta)
                        @php
                        $id +=1;
                        @endphp
                        <tr>
                            <td>{{$id}}</td>
                            <td>{{$alerta->mensagem}}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- Tabela de Logs de Registros -->
            <div class="col-md-6">
                <h2>Logs de Registos</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Funcionário</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $id =0;
                        @endphp
                        @foreach($log_registos as $log_registo )
                        @php
                        $id +=1;
                        @endphp
                        <tr>
                            <td>{{$id}}</td>
                            <td>{{$log_registo->user->name}}</td>
                            <td>{{$log_registo->acao}}</td>
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
