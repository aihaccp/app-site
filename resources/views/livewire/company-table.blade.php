<div>
    <h2 class="mb-4">Tabela de Estabelecimentos</h2>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>Id Organização</th>
                    <th>Nome</th>
                    <th>CAE</th>
                    <th>NIPC</th>
                    <th>Morada</th>
                    <th>Localidade</th>
                    <th>Status</th> <!-- Status 4 é para ativar os estabelecimentos-->
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->organition_id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->cae }}</td>
                    <td>{{ $company->nipc }}</td>
                    <td>{{ $company->morada }}</td>
                    <td>{{ $company->localidade }}</td>
                    <td>
                        <span class="badge status-{{ $company->plan_phasis }}">
                            @if ($company->plan_phasis == 1)
                                Preenchimento
                            @elseif ($company->plan_phasis == 2)
                                Validação
                            @elseif ($company->plan_phasis == 3)
                                Conclusão
                            @elseif ($company->plan_phasis == 4)
                                Confirmado
                            @endif
                        </span>
                    </td>
                    <td>
                        <button wire:click="selectCompany({{ $company->id }})" class="btn btn-primary" data-toggle="modal" data-target="#statusModal">+</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Atualizar Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($selectedCompany)
                    <form wire:submit.prevent="updateStatus">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select wire:model="status" class="form-control">
                                <option value="1" class="status-1">Preenchimento</option>
                                <option value="2" class="status-2">Validação</option>
                                <option value="3" class="status-3">Conclusão</option>
                                <option style="background-color: green;" value="4" class="status-4">Confirmado</option>
                            </select>
                            @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
