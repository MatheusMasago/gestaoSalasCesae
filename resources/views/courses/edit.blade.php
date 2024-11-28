@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('courses.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista cursos</a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Editar Curso</h3>
                            </div>
                            <form class="login-form" method="POST" action="{{ route('courses.update', $course->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <p class="d-block text-start" for="name" id="text_userType">Nome</p>
                                    <input id="name" type="text" class="form-control" name="name" autofocus
                                        value="{{ $course->name }}">
                                </div>
                                <div class="mb-3">
                                    <p class="d-block text-start" for="quantity_places" id="text_userType">Nome</p>
                                    <input id="quantity_places" type="text" class="form-control" name="quantity_places"
                                        autofocus value="{{ $course->quantity_places }}">
                                </div>

                                <div class="mb-3">
                                    <p class="d-block text-start" for="id_user" id="text_userType">Responsável</p>
                                    <select name="id_user" id="id_user" class="form-control">
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                {{ $course->id_user == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Atualizar Curso</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
