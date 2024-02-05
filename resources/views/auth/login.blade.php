@extends('layouts.appregisto')

@section('robot-image', 'img/mascote_fala.png')


@section('right-section')

    <div class="col-md-8 full-height"
        style="padding:3.5rem;background-color: #FEF9F2;display: flex; flex-direction: column; ">
        <div class="row" style>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <h3>Login</h3>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="custom-input form-control" name="email"
                    value="{{ old('email') }}" required autofocus>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" class="custom-input form-control" name="password" required>
                <a href="/forgot-password" style="color: #020041" class="d-block mt-2">Esqueci-me da Password</a>
                <!-- Link de recuperação de senha -->
            </div>

            <div class="row">
                <button type="submit"
                    style="font-weight:400; background-color: black !important; border:0px; border-radius:0px"
                    class="btn btn-primary">Login</button>
            </div>
            <div class="row">
                <!-- Botão para registro de empresas -->
                <a href="/registo-empresa" class="btn btn-secondary mt-3"
                    style="font-weight:400; background-color: grey !important; border:0px; border-radius:0px">A tua empresa
                    não
                    está registada? Regista-a</a>
            </div>
        </form>
    </div>
@endsection
