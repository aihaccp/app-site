<x-app-layout>
    <div class="container">
        <h5>Home / {{$module}} @if(isset($folder)) / {{$folder}} @endif @if(isset($registo)) / {{$registo}} @endif</h5>
        <div class="form-inline row pb-4" style="margin-bottom:0">
            <div class="col-lg-9 col-form-label">
                <div class="input-group shadow py-1 disabled" style="border-radius:10px;">
                    <span class="input-group-text border-0" id="search-addon" style="background:#FFFFFF">
                        <img src="{{asset('img/search.png')}}" width="18">
                    </span>
                    <input type="search" class="form-control border-0 py-2" placeholder="Search" aria-label="Search"
                        aria-describedby="search-addon" style="box-shadow: none; background-color: transparent" />
                </div>
            </div>
            <div class="col-lg-3 d-flex justify-content-around">
                <button type="submit" disabled class="btn btn-primary px-3 py-2"
                    style="font-size:1.1rem;border-radius:0.5rem;border-color:#6C99D3;color:#FFFFFF;background-color:#6C99D3">
                    Exportar
                    <img src="{{asset('img/export.png')}}" width="18" style="position: relative; display: inline-block">
                </button>

                <a href="{{url("/dashboard/{$module}/{$folder}/{$registo}/adicionar")}}" style="text-decoration: none">
                    <button type="submit" class="btn btn-primary px-3 py-2"
                        style="font-size:1.1rem;border-radius:0.5rem;border-color:#6C99D3;color:#FFFFFF;background-color:#6C99D3">
                        Adicionar
                        <img src="{{asset('img/plus.png')}}" width="18"
                            style="position: relative; display: inline-block">
                    </button>
                </a>
            </div>
        </div>
        @foreach($registos as $registo)
        <div class="card flex-row shadow"
            style="border-radius:10px; border:0px;height:auto;cursor:pointer;margin-top: 2%">
            <div class="card-body p-3">

                <div class="row justify-content-between">
                    <div class="col-lg-4">
                        <h5>Problema:</h5>
                        <p class="my-0">{{ $registo->problema}}</p>
                    </div>
                    <div class="col-lg-5">
                        <h5>Descrição:</h5>
                        <p class="my-0">{{ $registo->descricao}}</p>
                    </div>
                    <div class="col-lg-3  text-right">
                        <p class="my-0">{{ $registo->created_at->format('d/m/Y H:i') }}</p>
                    </div>

                </div>
                <div class="row justify-content-end">
                    <div class="col-auto p-0 d-flex align-items-center">

                        <p class="m-0">{{ Auth::user()->name}}</p>
                    </div>
                    <div class="col-auto d-flex align-items-center">
                        <img class="profile-img"
                            style="width:25px;height:25px;border-radius:50%;border: #000 solid 2px;object-fit:cover; padding: 1px; display:block; margin-left:auto"
                            src="@if(App\Models\User::where('id',$registo->id_user)->first()->avatar !== null){{env('APP_URL')}}/storage/{{ App\Models\User::where('id',$registo->id_user)->first()->avatar }}@else{{asset('img/user.png')}}@endif">
                    </div>


                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>