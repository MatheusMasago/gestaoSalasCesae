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
                                <h3 class="text-center flex-grow-1 m-0">Informações do Curso</h3>
                            </div>
                            <!-- Linha com sombra sem espaço nas laterais -->
                            <div class="shadow-sm mb-3" style="height: 1px; background-color: #ddd; width: 100%;"></div>
                            <!-- Linha sem margem -->
                            <div class="d-flex align-items-center mb-3">
                                <strong>Nome:</strong> {{ $course->name }}
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <strong>Quantidade de Vagas:</strong> {{ $course->quantity_places }}
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                <strong>Responsável:</strong>
                                @if ($course->user)
                                    {{ $course->user->name }}
                                @else
                                    Nenhum responsável atribuído
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
