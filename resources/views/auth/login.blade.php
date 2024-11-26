@extends('layouts.no-components')

@section('content')
    <div class="position-absolute top-0 start-0">
        <img src="{{ asset('images/background1.png') }}" width="300" height="290" alt="">
    </div>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="row w-100 mx-3 align-items-center">
            <!-- Coluna para a logo -->
            <div class="col-md-6 text-center">
                <img src="{{ asset('images/logo_cesae-cores_horizontal.png') }}" id="img_cesae" width="370" height="190"
                    alt="">
            </div>

            <!-- Coluna para o formulário de login -->
            <div class="col-md-6 text-center">
                <div class="login-page">
                    <div class="form shadow p-4 rounded bg-light">
                        <h3 class="mb-4">Login</h3>
                        <form class="login-form" method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <input type="email" name="email" id="email" class="form-control"
                                    value="{{ old('email') }}" required autofocus placeholder="email">
                                @error('email')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input type="password" name="password" id="password" class="form-control" required
                                    placeholder="senha">
                                @error('password')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100"> {{ __('Login') }}</button>
                            <div class="container mt-5">
                                <p class="message mt-3">
                                    Não tens conta? <a href="{{ route('register') }}" id="ancoraText">Registe-se!</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-absolute bottom-0 end-0">
        <img src="{{ asset('images/background2.png') }}" width="390" height="350" alt="">
    </div>
@endsection
