<x-app-layout>

    <div class="container">
      <h5>Home / Fornecedores</h5>
      <div class="form-inline row pb-4" style="margin-bottom:0">

          <div class="col-lg-12 d-flex justify-content-end">

              <a href="" style="text-decoration: none">
                  <button type="submit" class="btn btn-primary px-3 py-2" style="font-size:1.1rem;border-radius:0.5rem;border-color:#6C99D3;color:#FFFFFF;background-color:#6C99D3">
                      Adicionar
                      <img src="{{asset('img/plus.png')}}" width="18" style="position: relative; display: inline-block">
                  </button>
              </a>
          </div>
      </div>
      <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                      <th scope="col">Nome</th>
                      <th scope="col">Morada</th>
                      <th scope="col">Interlocutor</th>
                      <th scope="col">Telefone</th>
                      <th scope="col">Telemovel</th>
                      <th scope="col">Email</th>
                      <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($fornecedores as $fornecedor)
                    <tr>

                        <td>{{ $fornecedor->Nome }}</td>
                        <td>{{ $fornecedor->Morada }}</td>
                        <td>{{ $fornecedor->Interlocutor }}</td>
                        <td>{{ $fornecedor->Telefone }}</td>
                        <td>{{ $fornecedor->Telemovel }}</td>
                        <td>{{ $fornecedor->Email }}</td>
                        <td style="vertical-align:middle">
                            <a class="dropdown" style="display: block; margin-left: auto;" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="False">
                                <img src="{{asset('img/dots.png')}}" style="height: 1.25rem;">
                            </a>
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>




</x-app-layout>
