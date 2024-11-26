@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('locals.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista locais</a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Editar Local</h3>
                            </div>
                            <form class="login-form" method="POST" action="{{ route('locals.update', $local->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <input id="name" type="text" class="form-control" name="name" required
                                        autofocus value="{{ $local->name }}">
                                </div>

                                <button type="submit" class="btn btn-primary w-100">Atualizar Local</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
