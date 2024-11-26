{{-- <!-- resources/views/rooms/show.blade.php -->

@extends('home.index')

@section('content')

    <body>
        <div class="container">
            <h2>Detalhes da Sala</h2>

            <div class="card">
                <div class="card-header">
                    <h5>{{ $room->name }}</h5>
                </div>

                <div class="card-body">
                    <p><strong>Capacidade:</strong> {{ $room->capacity }}</p>
                    <p><strong>Local:</strong> {{ $room->local->name }}</p>

                    <div class="mt-3">
                        <a href="{{ route('rooms.index') }}" class="btn btn-secondary">Voltar</a>
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Tem certeza que deseja excluir esta sala?')">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
@endsection

 --}}

@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('rooms.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista salas
        </a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Detalhes da Sala</h3>
                            </div>
                            <!-- Linha com sombra sem espaço nas laterais -->
                            <div class="shadow-sm mb-3" style="height: 1px; background-color: #ddd; width: 100%;"></div>
                            <!-- Linha sem margem -->
                            <div class="d-flex align-items-center mb-3">
                                <h4><strong>Local:</strong> {{ $room->local->name }}</h4>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <h5><strong>Capacidade:</strong> {{ $room->capacity }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
