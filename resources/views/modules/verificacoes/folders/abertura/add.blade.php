<x-app-layout>
    <div class="container">
        <h5>Home / {{$module}} @if(isset($folder)) / {{$folder}} @endif / Novo Registo</h5>
        <div class="row" style="margin-top:2%">
            <div class="col-lg-7 col-md-7">
                <h4>NOVO REGISTO</h4>
                <form method="post" action="{{route('submeterRegistoVerificacao')}}" id="formRegisto" style="margin-top:2%">
                    @csrf
                    <input type="hidden" name="module" value="{{$module}}">
                    @if(isset($folder))
                    <input type="hidden" name="folder" value="{{$folder}}">
                    @endif
                    @if(isset($registo))
                    <input type="hidden" name="registo" value="{{$registo}}">
                    @endif
                    <input type="hidden" name="tipo" value="{{$tipo}}">

                    @foreach($verificacoes as $verificacao)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="{{$verificacao->id}}" name="{{$verificacao->id}}">
                        <label class="form-check-label" for="{{$verificacao->id}}">
                            {{ $verificacao->designacao }}
                        </label>
                    </div>
                    @endforeach

                    <div class="row pb-2 pt-1 d-flex align-items-center">
                        <div class="col-auto pr-0 d-flex align-items-center">
                            <h5 class="m-0">Operador:</h5>
                        </div>
                        <div class="col-auto p-0">
                            <a class="nav-link p-2">
                                <img class="profile-img" style="width:25px;height:25px;border-radius:50%;border: #000 solid 2px;object-fit:cover; padding: 1px"
                                src="@if(Auth::user()->avatar!=null){{env('APP_URL')}}/storage/{{ Auth::user()->avatar }}@else{{asset('img/user.png')}}@endif">
                            </a>
                        </div>
                        <div class="col-auto p-0 d-flex align-items-center">

                            <p class="m-0">{{ Auth::user()->name}}</p>
                        </div>
                    </div>

                    <div class="row py-2 d-flex align-items-center">
                        <div class="col-auto pr-0 d-flex align-items-center">
                            <p>{{date('d/m/Y H:i', time())}}</p>
                        </div>
                    </div>

                    <div class="row pt-3 pb-0 ">
                        <div class="col-auto ml-auto">
                            <button type="submit" class="btn btn-primary px-3 py-2" style="font-size:1.1rem;border-radius:0.5rem;border-color:#6C99D3;color:#FFFFFF;background-color:#6C99D3" id="submeterRegisto">Submeter</button>
                        </div>
                    </div>
                </form>
            </div>


            <div class="col-lg-5 col-md-5 border-left">
                <h4>HISTÓRICO</h4>
                @foreach($registos as $registo)
                <div class="row pb-2">
                    <div class="col">
                        <div class="card shadow" style="border-radius:10px; border:0px">
                            <div class="card-body p-2">
                                <div class="row justify-content-between">
                                    <div class="col-lg-7 ">
                                        <p class="my-0">{{ $registo->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div class="col-lg-5  text-right">
                                        <a class="nav-link pr-1">
                                            <img class="profile-img" style="width:25px;height:25px;border-radius:50%;border: #000 solid 2px;object-fit:cover; padding: 1px; display:block; margin-left:auto"
                                                src="@if(App\Models\User::where('id',$registo->id_user)->first()->avatar!=null){{env('APP_URL')}}/storage/{{ App\Models\User::where('id',$registo->id_user)->first()->avatar }}@else{{asset('img/user.png')}}@endif">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

    </div>
    </x-app-layout>
