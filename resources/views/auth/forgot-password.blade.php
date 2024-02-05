@extends('layouts.appregisto')

@section('robot-image', 'img/mascote_fala.png')

@section('right-section')

    <div class="col-md-8 full-height" style="padding:3.5rem;background-color: #FEF9F2;">
        <div class="row">
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
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <h3>Esqueci-me da Password</h3>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" class="custom-input form-control" name="email"
                    value="{{ old('email') }}" required autofocus>
            </div>
            <button type="submit" style="font-weight:400;background-color: black !important;border:0px;border-radius:0px"
                class="btn btn-primary">Email Password Reset Link</button>
        </form>
    </div>
@endsection
