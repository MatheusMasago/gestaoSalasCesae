@extends('layouts.main_layout')

@section('content')
    <div id="feedback-form" class="mt-5" style="position: relative; padding-right: 2em;">
        <a href="{{ route('login') }}"
            style="position: absolute; top: 1.5em; right: 2em; color: #000000; text-decoration: none;">
            Voltar
        </a>
        <h2>Registre-se</h2>

        <div>
            <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data" style="margin-top: -1.5em;" onsubmit="return alert('Usuário inserido com sucesso!')"
            style="display: inline-block;">
                @csrf

                <div class="form-group mb-3" id="closer">
                    <label for="inputName">Nome</label>
                    <input type="text" name="name" value="{{ isset($user) ? $user->name : '' }}" class="form-control" required
                        style="background-color: #fff; border: 1px solid #dee2e6;">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3" id="closer">
                    <label for="inputEmail">E-mail</label>
                    <input type="email" name="email" value="{{ isset($user) ? $user->email : '' }}" class="form-control" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3" id="closer">
                    <label for="inputPassword">Senha</label>
                    <input type="password" name="password" value="{{ isset($user) ? '' : '' }}" class="form-control" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="user_type" class="form-label">Tipo de Usuário</label>
                    <select name="user_type" id="user_type" class="form-control @error('user_type') is-invalid @enderror"
                        required>
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

                <button type="submit" class="btn btn-primary" style="width: 16em; margin-bottom:-1em">Criar Conta</button>
            </form>
        </div>
    </div>
@endsection
