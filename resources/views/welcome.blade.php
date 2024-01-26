<x-app-layout>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Formulário Plano HACCP</h2>
                <form action="/submit" method="post">
                    <div id="processSteps">
                        <div class="form-group">
                            <label for="step1">Etapa do Processo:</label>
                            <input type="text" class="form-control" id="step1" name="step[]">
                        </div>
                    </div>
                    <button type="button" class="btn btn-dark mb-3" onclick="addStep()" style="color: white;">Adicionar mais etapas</button>

                    <div class="form-group">
                        <label for="products">Produtos ou Ingredientes:</label>
                        <textarea class="form-control" id="products" name="products" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="practices">Práticas:</label>
                        <textarea class="form-control" id="practices" name="practices" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-dark" style="color: white;">Submeter</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let stepCount = 1;

        function addStep() {
            stepCount++;
            const stepDiv = document.createElement('div');
            stepDiv.classList.add('form-group');
            stepDiv.innerHTML = `
                <label for="step${stepCount}">Etapa do Processo:</label>
                <input type="text" class="form-control" id="step${stepCount}" name="step[]">
            `;
            document.getElementById('processSteps').appendChild(stepDiv);
        }
    </script>

</x-layout-app>
