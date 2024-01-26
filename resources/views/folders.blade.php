<x-app-layout>
    <div class="container">
        <h5 style="margin-top:0.8rem;">Home / {{$module->name}}</h5>
        <div class="row" style="margin-top:2%">
            @foreach ($folders as $folderAux)
            <div class="col-md-8 @if($folderAux->disabled == 1) disabled @endif">

                <a href="{{ route('folders-show', ['moduleSlug' => $module->slug, 'folderSlug' => $folderAux->slug, 'fileSlug' => 'arquivo', 'uuid' => session('uuid')]) }}" style="text-decoration:none">

                        <div class="card shadow" onmouseover="this.style.transform='scale(1.05)'"
                            onmouseout="this.style.transform='scale(1)'"
                            style="cursor:pointer;border:0;color:#000000;background-color:#fff;border-radius:5px;transition: transform 0.3s ease-in-out;margin-top:5%">
                            <div class="card-body align-items-center" style="padding:10">

                                <div class="row">
                                    <div class="col-auto">
                                        @if(isset($folderAux->icon))
                                        <img src="{{asset('img/'.$folderAux->icon)}}" style="height:2rem">
                                        @else
                                        <img src="{{asset('img/folder.png')}}" style="height:2rem">
                                        @endif
                                    </div>

                                    <div class="col-auto">
                                        <h5 style="margin-bottom:0; margin-top:2%">{{$folderAux->name}}</h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

