<x-app-layout>
    <div class="container">
        <div class="row pb-4 align-items-center" style="margin:0; margin-top:2rem;">
            <h6 class="mb-0">HOME / IMPRESSOS/ PLANOS / AÇÕES CORRETIVAS / NOVO REGISTO</h6>
        </div>
        <div class="row">
            <div class="col-lg-7 col-md-7">
                <h4>NOVO REGISTO</h4>
                <form method="post" action="{{route('submeterDemonstracaoProcedimento')}}" id="formRegisto">
                    @csrf
                    <input type="hidden" name="module" value="{{$module}}">
                    @if(isset($folder))
                    <input type="hidden" name="folder" value="{{$folder}}">
                    @endif
                    @if(isset($registo))
                    <input type="hidden" name="registo" value="{{$registo}}">
                    @endif


                    <div class="row pb-2 pt-1 d-flex align-items-center">
                        <div class="col-auto pr-0 d-flex align-items-center">
                            <h6 class="m-0">Operador:</h6>
                        </div>
                        <div class="col-auto p-0">
                            <a class="nav-link p-2">
                                <img class="profile-img"
                                    style="width:25px;height:25px;border-radius:50%;border: #000 solid 2px;object-fit:cover; padding: 1px;"
                                    src="@if(Auth::user()->avatar!=null){{env('APP_URL')}}/storage/{{ Auth::user()->avatar }}@else{{asset('img/user.png')}}@endif">
                            </a>
                        </div>
                        <div class="col-auto p-0 d-flex align-items-center">

                            <p class="m-0">{{ Auth::user()->name}}</p>
                        </div>
                    </div>

                    <div class="row pb-2" style="margin:0">
                        <div class="input-group">
                            <textarea placeholder="Ponto de Segurança"
                                class="form-control form-control-lg shadow py-3" style="border:0px; font-size: 1.1rem;"
                                name="ponto_seguranca" rows="3" cols="50"></textarea>

                        </div>
                    </div>
                    <div class="row pb-2" style="margin:0">
                        <div class="input-group">
                            <textarea placeholder="Explicação da demonstração usada"
                                class="form-control form-control-lg shadow py-3" style="border:0px; font-size: 1.1rem;"
                                name="explicacao" rows="3" cols="50"></textarea>

                        </div>
                    </div>
                    <div class="row py-2 d-flex align-items-center">
                        <div class="col-auto pr-0 d-flex align-items-center">
                            <p>{{date('d/m/Y H:i', time())}}</p>
                        </div>
                    </div>

                    <div class="row pt-3 pb-0 ">
                        <div class="col-auto ml-auto">
                            <button type="submit" class="btn btn-primary px-3 py-2"
                                style="font-size:1.1rem;border-radius:0.5rem;border-color:#6C99D3;color:#FFFFFF;background-color:#6C99D3">Submeter</button>
                        </div>
                    </div>
                </form>
            </div>



        </div>

    </div>
</x-app-layout>