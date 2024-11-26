{{-- <!-- resources/views/locals/show.blade.php -->

@extends('home.index')

@section('content')

    <body>
        <div class="container">
            <h2>Detalhes do Local</h2>

            <div class="card">
                <div class="card-header">
                    <h4>{{ $local->name }}</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Nome:</strong> {{ $local->name }}</li>
                        <!-- Adicione outros campos do local se necessário -->
                    </ul>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ route('locals.index') }}" class="btn btn-secondary">Voltar para a lista</a>
                    <a href="{{ route('locals.edit', $local->id) }}" class="btn btn-warning">Editar</a>
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
        <a href="{{ route('locals.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista locais
        </a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Detalhes do Local</h3>
                            </div>
                            <!-- Linha com sombra sem espaço nas laterais -->
                            <div class="shadow-sm mb-3" style="height: 1px; background-color: #ddd; width: 100%;"></div>
                            <!-- Linha sem margem -->

                            <div class="d-flex align-items-center mb-3">
                                <h4><strong>Nome:</strong> {{ $local->name }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
