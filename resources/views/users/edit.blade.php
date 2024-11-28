{{-- @extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('users.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista de usuários</a>
        <h1>Editar Usuário</h1>
        <form action="{{ route('users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Nome -->
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- Email -->
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="{{ old('email', $user->email) }}" required>
            </div>

            <!-- Tipo de Usuário -->
            <div class="form-group">
                <label for="user_type">Tipo de Usuário</label>
                <select id="user_type" name="user_type" class="form-control" required>
                    <option value="Admin" {{ $user->user_type == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Moderator" {{ $user->user_type == 'Moderator' ? 'selected' : '' }}>Moderator</option>
                    <option value="Formador" {{ $user->user_type == 'Formador' ? 'selected' : '' }}>Formador</option>
                </select>
            </div>

            <!-- Senha -->
            <div class="form-group">
                <label for="password">Nova Senha (opcional)</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <!-- Confirmação de Senha -->
            <div class="form-group">
                <label for="password_confirmation">Confirmar Nova Senha</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
            </div>

            <!-- Botões -->
            <button type="submit" class="btn btn-success">Salvar Alterações</button>
            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection


 --}}

@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('users.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista de usuários
        </a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Editar Usuário</h3>
                            </div>
                            <form class="login-form" method="POST" action="{{ route('users.update', $user) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <p class="d-block text-start" for="id_user" id="text_userType">Nome </p>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name', $user->name) }}" autofocus placeholder="nome">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <p class="d-block text-start" for="id_email" id="text_userType">Email</p>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', $user->email) }}" placeholder="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Tipo de Usuário -->
                                <div class="mb-3">
                                    <p class="d-block text-start" for="user_type" id="text_userType">Tipo de Usuário</p>
                                    <select id="user_type" name="user_type" class="form-control">
                                        <option value="Admin" {{ $user->user_type == 'Admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="Moderator" {{ $user->user_type == 'Moderator' ? 'selected' : '' }}>
                                            Moderator</option>
                                        <option value="Formador" {{ $user->user_type == 'Formador' ? 'selected' : '' }}>
                                            Formador</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <p class="d-block text-start" for="id_password" id="text_userType">Nova Senha </p>
                                    <input type="password" id="password" name="password" class="form-control"
                                        placeholder="nova senha (opcional)">
                                </div>

                                <div class="mb-3">
                                    <p class="d-block text-start" for="id_password" id="text_userType">Confirme a Senha </p>
                                    <input id="password_confirmation" type="password" class="form-control"
                                        name="password_confirmation" placeholder="confirme a nova senha">
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Salvar Alterações</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
