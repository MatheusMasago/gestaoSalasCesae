@extends('layouts.no-components')

@section('content')
    <div class="position-absolute top-0 start-0" id="container_registerPage">
        <img src="{{ asset('images/background1.png') }}" width="300" height="290" alt="">
    </div>

    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="row w-100 mx-3 align-items-center">

            <!-- Coluna para o formulário de registro -->
            <div class="col-md-6 text-center">
                <div class="login-page" id="registerBlade">
                    <div class="form shadow p-4 rounded bg-light">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h3 class="text-center flex-grow-1 m-0">Registo</h3>
                            <a href="{{ route('login') }}" class="text-end" id="ancoraText">Voltar</a>
                        </div>
                        <form class="login-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-3">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autofocus placeholder="nome">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input id="email" type="email"
                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required placeholder="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password" required
                                    placeholder="senha">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <input id="password_confirmation" type="password" class="form-control"
                                    name="password_confirmation" required placeholder="confirme a senha">
                            </div>

                            {{--                             <div class="mb-3">
                                <p class="d-block text-start" for="user_type" id="text_userType">Tipo de Usuário</p>
                                <select name="user_type" id="user_type"
                                    class="form-control @error('user_type') is-invalid @enderror" required
                                    style="margin-top: -0.7em">
                                    <option value="{{ \App\Models\User::TYPE_ADMIN }}"
                                        {{ isset($user) && $user->user_type == \App\Models\User::TYPE_ADMIN ? 'selected' : '' }}>
                                        Administrador</option>
                                    <option value="{{ \App\Models\User::TYPE_MODERATOR }}"
                                        {{ isset($user) && $user->user_type == \App\Models\User::TYPE_MODERATOR ? 'selected' : '' }}>
                                        Moderador</option>
                                    <option value="{{ \App\Models\User::TYPE_FORMADOR }}"
                                        {{ isset($user) && $user->user_type == \App\Models\User::TYPE_FORMADOR ? 'selected' : '' }}>
                                        Formador</option>
                                </select>
                                @error('user_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}

                            <button type="submit" class="btn btn-primary w-100"> {{ __('Register') }}</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Coluna para a logo -->
            <div class="col-md-6 text-center">
                <img id="imageRegister" id="img_cesae" src="{{ asset('images/logo_cesae-cores_horizontal.png') }}"
                    width="370" height="190" alt="">
            </div>
        </div>
    </div>

    <div class="position-absolute bottom-0 end-0">
        <img src="{{ asset('images/background2.png') }}" width="390" height="350" alt="">
    </div>
@endsection
