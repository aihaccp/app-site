<x-app-layout>
    <div class="container">
        <h5>Home / {{ $module->name }} @if (isset($folder))
                / {{ $folder->name }}
            @endif
        </h5>
        <div class="row mt-3">
            @foreach ($files as $file)
                <div class="col-md-4 mx-auto mb-3">
                    <div class="card shadow-sm" style="border-radius:15px;">
                        <div class="card-body d-flex align-items-center">
                            <!-- Ícone do arquivo -->
                            @php
                                $extension = pathinfo($file->avatar, PATHINFO_EXTENSION);
                            @endphp
                            <img src="{{ asset($extension === 'pdf' ? 'img/pdf.png' : 'img/doc.png') }}"
                                style="height:2rem; margin-right: 1%">

                            <h5 class="mb-0 flex-grow-1">{{ $file->name }}</h5>

                            <!-- Dropdown de ações -->
                            <div class="dropdown">
                                <a class="text-secondary" href="#" role="button"
                                    id="dropdownMenuLink{{ $file->id }}" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <img src="{{ asset('img/dots.png') }}" style="height:2rem">
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink{{ $file->id }}">
                                    <!-- Botão Modificar -->
                                    <button class="dropdown-item"
                                        onclick="document.getElementById('ficheiro{{ $file->id }}').click();">Modificar</button>
                                    <input type="file" hidden id="ficheiro{{ $file->id }}"
                                        accept=".doc, .docx, .pdf"
                                        onchange="event.preventDefault(); document.getElementById('formModificar{{ $file->id }}').submit();">

                                    <!-- Formulário de Modificação -->
                                    <form method="post" action="{{ route('modificarFicheiro') }}"
                                        id="formModificar{{ $file->id }}" enctype="multipart/form-data"
                                        style="display:none;">
                                        @csrf
                                        <input hidden name="id" value="{{ $file->id }}">
                                        <input type="hidden" name="module" value="{{ $module->name }}">
                                        @if (isset($folder))
                                            <input type="hidden" name="folder" value="{{ $folder->name }}">
                                        @endif
                                    </form>

                                    <!-- Exemplo de Link de Download Direto -->
                                    <a href="http://127.0.0.1:8000/storage/public/{{ $file->avatar }}"
                                        download="{{ $file->name }}">
                                        <button type="button">
                                            <ion-icon name="download-outline"></ion-icon> Download
                                        </button>
                                    </a>


                                    <!-- Botão Exportar PDF (condicional) -->
                                    @if ($extension !== 'pdf')
                                        <button class="dropdown-item" disabled>Exportar PDF</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
