<x-app-layout>
<div class="container">
    <h5>Home / {{$module->name}} @if(isset($folder)) / {{$folder->name}} @endif</h5>
    <div class="row" style="margin-top:3%">
        @foreach ($files as $file)
            <div class="col-md-10 mx-auto">
                <div class="card shadow" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'" style="cursor:pointer;border:0;color:#000000;font-family: 'Bebas Neue', cursive;background-color:#fff;border-radius:15px;transition: transform 0.3s ease-in-out;margin-top:2%;">
                    <div class="card-body d-flex align-items-center"  style="padding:10">
                        @if(explode(".",$file->avatar)[count(explode(".",$file->avatar))-1] === "pdf")
                            <img src="{{asset('img/pdf.png')}}"  style="height:2rem; margin-right: 1%">
                        @else
                            <img src="{{asset('img/doc.png')}}"  style="height:2rem; margin-right: 1%">
                        @endif

                        <h5 style="margin-bottom:0">{{$file->name}}</h5>

                        <a class="dropdown" style="display:block; margin-left: auto" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="False">
                            <img src="{{asset('img/dots.png')}}"  style="height:2rem">
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <form method="post" action="{{route('modificarFicheiro')}}" id="formModificar{{$file->id}}" enctype="multipart/form-data">
                                @csrf
                                <input hidden name="id" value="{{$file->id}}"></input>
                                <input type="hidden" name="module" value="{{$module->name}}">
                                @if(isset($folder))
                                <input type="hidden" name="folder" value="{{$folder->name}}">
                                @endif
                                <label for="ficheiro{{$file->id}}" style="padding:4px 24px 4px 24px;font-weight:normal;cursor:pointer; margin:0">
                                    Modificar
                                </label>
                                <input type="file" style="display:none" class="form-control-file" name="ficheiro" id="ficheiro{{$file->id}}" accept=".doc, .docx, .pdf" required></input>
                            </form>
                            <form method="post" action="{{route('downloadFicheiro')}}">
                                @csrf
                                <input hidden name="id" value="{{$file->id}}"></input>
                                <input type="hidden" name="module" value="{{$module}}">
                                <button class="dropdown-item" type="submit">Download</button>
                            </form>
                            @if(explode(".",$file->avatar)[count(explode(".",$file->avatar))-1] !== "pdf")
                            <form method="post" action="{{route('exportarPdf')}}">
                                @csrf
                                <input hidden name="id" value="{{$file->id}}"></input>
                                <input type="hidden" name="module" value="{{$module}}">
                                <button class="dropdown-item" type="submit" disabled>Exportar pdf</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    var something=<?php echo json_encode($files); ?>;
    for(let i=0; i<something.length; i++) {
        document.getElementById("ficheiro"+something[i].id).onchange = function() {
            document.getElementById("formModificar"+something[i].id).submit();
        };
    }
</script>
</x-layout-app>
