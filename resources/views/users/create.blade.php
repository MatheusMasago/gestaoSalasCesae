@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('users.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista de usuários</a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Criar Usuário</h3>
                            </div>
                            <form class="login-form" method="POST" action="{{ route('addUser') }}">
                                @csrf
                                <div class="mb-3">
                                    <p class="d-block text-start" for="name" id="text_userType">Nome</p>
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
                                    <p class="d-block text-start" for="email" id="text_userType">Email</p>
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
                                    <p class="d-block text-start" for="password" id="text_userType">Senha</p>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required placeholder="senha">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <p class="d-block text-start" for="password_confirmation" id="text_userType">Confirme a
                                        Senha</p>
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" required placeholder="confirme a senha">
                                </div>

                                <div class="mb-3">
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
                                </div>

                                <button type="submit" class="btn btn-primary w-100"> {{ __('Criar usuário') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
