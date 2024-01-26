<x-app-layout>
<div class="container">
    <div class="row pb-4 align-items-center">
        <h6 class="mb-0">Home / {{$module}} @if(isset($folder)) / {{$folder}} @endif @if(isset($registo)) / {{$registo}} @endif</h6>
    </div>
    <div class="form-inline row pb-4" style="margin-bottom:0">
        <div class="col-lg-9 col-form-label">
            <div class="input-group shadow py-1 disabled" style="border-radius:10px;">
                <span class="input-group-text border-0" id="search-addon" style="background:#FFFFFF">
                    <img src="{{asset('img/search.png')}}" width="18">
                </span>
                <input type="search" class="form-control border-0 py-2" placeholder="Search" aria-label="Search" aria-describedby="search-addon" disabled style="box-shadow:none; background-color: transparent"/>
            </div>
        </div>
        <div class="col-lg-3 d-flex justify-content-around">
            <button type="submit" disabled class="btn btn-primary px-3 py-2" style="font-size:1.1rem;border-radius:0.5rem;border-color:#6C99D3;color:#FFFFFF;background-color:#6C99D3">
                Exportar
                <img src="{{asset('img/export.png')}}" width="18" style="position: relative; display: inline-block">
            </button>

            <a href="{{route('registo-add', ['moduleSlug' => $module, 'folderSlug' => $folder, 'uuid'=>session('uuid')])}}" style="text-decoration: none">
                <button type="submit" class="btn btn-primary px-3 py-2" style="font-size:1.1rem;border-radius:0.5rem;border-color:#6C99D3;color:#FFFFFF;background-color:#6C99D3">
                    Adicionar
                    <img src="{{asset('img/plus.png')}}" width="18" style="position: relative; display: inline-block">
                </button>
            </a>

        </div>
    </div>





    @foreach($registos as $registo)
    <div class="card flex-row shadow" style="border-radius:10px; border:0px;height:5.5rem;cursor:pointer;margin-top:2%">
        <img class="card-img-left example-card-img-responsive" style="border-radius: 10px 0px 0px 10px;overflow: hidden;" src="/img/sanitation_image.jpeg"/>
        <div class="card-body p-3">

            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <h6>{{App\Models\Area::where('id', App\Models\Equipamento::where('id', $registo->id_equipamento)->first()->id)->first()->designacao}} - {{ App\Models\Equipamento::where('id', $registo->id_equipamento)->first()->nome}}</h6>
                </div>
                <div class="col-lg-5  text-right">
                    <p class="my-0">{{ $registo->created_at->format('d/m/Y H:i') }}</p>
                </div>

            </div>
            <div class="row justify-content-between">
                <div class="col-lg-7 ">
                    <p class="my-0" style="@if($registo->temp >= $registo->temp_min && $registo->temp <= $registo->temp_max) color:green @else color:red @endif">{{$registo->temp}} ºC</p>
                </div>
                <div class="col-lg-5  text-right">
                    <a class="nav-link pr-1">
                        <img class="profile-img" data-toggle="tooltip" data-placement="top" title="{{App\Models\User::where('id',$registo->id_user)->first()->name}}" style="width:25px;height:25px;border-radius:50%;border: #000 solid 2px;object-fit:cover; padding: 1px; display:block; margin-left:auto"
                            src="@if(App\Models\User::where('id',$registo->id_user)->first()->avatar !== null){{env('APP_URL')}}/storage/{{ App\Models\User::where('id',$registo->id_user)->first()->avatar }}@else{{asset('img/user.png')}}@endif">
                    </a>
                </div>

            </div>
        </div>
    </div>
    @endforeach

</div>
</x-app-layout>
