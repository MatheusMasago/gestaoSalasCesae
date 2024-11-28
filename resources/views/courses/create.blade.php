{{-- <!-- resources/views/courses/create.blade.php -->

@extends('home.index')

@section('content')

    <body>
        <div class="container">
            <h2>Criar Novo Curso</h2>

            <form action="{{ route('courses.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Nome do Curso</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="quantity_places">Quantidade de Vagas</label>
                    <input type="number" name="quantity_places" id="quantity_places" class="form-control"
                        value="{{ old('quantity_places') }}" required>
                </div>

                <div class="form-group">
                    <label for="id_user">Responsável</label>
                    <select name="id_user" id="id_user" class="form-control" required>
                        <option value="">Selecione o responsável</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Salvar</button>
            </form>
        </div>
    </body>
@endsection
 --}}


@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('courses.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista de cursos</a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Criar Curso</h3>
                            </div>
                            <form class="login-form" method="POST" action="{{ route('courses.store') }}">
                                @csrf
                                <div class="mb-3">
                                    <p class="d-block text-start" for="name" id="text_userType">Nome do Curso</p>
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
                                    <p class="d-block text-start" for="quantity_places" id="text_userType">Quantidade de
                                        Vagas
                                    </p>
                                    <input id="quantity_places" type="number"
                                        class="form-control @error('capacity') is-invalid @enderror" name="quantity_places"
                                        value="{{ old('quantity_places') }}" required placeholder="quantidade de lugares">

                                    @error('quantity_places')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <p class="d-block text-start" for="id_user" id="text_userType">Responsável</p>
                                    <select name="id_user" id="id_user" class="form-control" required>
                                        <option value="">Selecione o responsável</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ old('id_user') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Criar Curso</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
