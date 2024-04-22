<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="container mt-5">
        <button id="finalizeButton" class="btn btn-primary">Finalizar</button>

        <div id="loadingStatus" style="display:none;">
            <div id="processingDocs"><span class="spinner-border spinner-border-sm"></span> A Processar os documentos...</div>
            <div id="creatingPlan"><span class="spinner-border spinner-border-sm"></span> A Criar o teu Plano de SGSA...</div>
            <div id="verifyingPlan"><span class="spinner-border spinner-border-sm"></span> A Verificar Plano de SGSA...</div>
            <div id="completed" style="display:none;"><i class="fas fa-check"></i> Concluído</div>
            <button id="viewButton" class="btn btn-success" style="display:none;">Visualizar</button>
        </div>
    </div>

    <script>
        document.getElementById('finalizeButton').addEventListener('click', function() {
            var loadingStatus = document.getElementById('loadingStatus');
            var processingDocs = document.getElementById('processingDocs');
            var creatingPlan = document.getElementById('creatingPlan');
            var verifyingPlan = document.getElementById('verifyingPlan');
            var completed = document.getElementById('completed');
            var viewButton = document.getElementById('viewButton');

            // Mostra todos os status de loading
            loadingStatus.style.display = 'block';

            // Processo simulado para processar documentos
            setTimeout(function() {
                processingDocs.innerHTML = '<i class="fas fa-check"></i> A Processar os documentos...';

                // Processo simulado para criar plano
                setTimeout(function() {
                    creatingPlan.innerHTML = '<i class="fas fa-check"></i> A Criar o teu Plano de SGSA...';

                    // Processo simulado para verificar plano
                    setTimeout(function() {
                        verifyingPlan.innerHTML = '<i class="fas fa-check"></i> A Verificar Plano de SGSA...';
                        completed.style.display = 'block';
                        viewButton.style.display = 'block';

                    }, 2000); // Tempo para verificar plano

                }, 2000); // Tempo para criar plano

            }, 2000); // Tempo para processar documentos
        });
    </script>
</div>
