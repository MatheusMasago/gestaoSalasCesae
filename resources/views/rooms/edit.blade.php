@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('rooms.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista salas</a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Editar Sala</h3>
                            </div>
                            <form class="login-form" method="POST" action="{{ route('rooms.update', $room->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <input id="name" type="text" class="form-control" name="name" required
                                        autofocus value="{{ $room->name }}">
                                </div>
                                <div class="mb-3">
                                    <input id="capacity" type="text" class="form-control" name="capacity" required
                                        autofocus value="{{ $room->capacity }}">
                                </div>
                                <div class="mb-3">
                                    <label for="id_local">Local</label>
                                    <select name="id_local" id="id_local" class="form-control" required>
                                        @foreach ($locals as $local)
                                            <option value="{{ $local->id }}"
                                                {{ $room->id_local == $local->id ? 'selected' : '' }}>
                                                {{ $local->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Atualizar Sala</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
