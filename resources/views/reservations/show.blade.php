@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('reservations.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista reservas
        </a>
        <div class="d-flex align-items-center justify-content-center" style="min-height: 60vh;">
            <div class="row align-items-center">
                <div class="text-center">
                    <div class="login-page">
                        <div class="form shadow p-4 rounded bg-light mx-auto" style="width: 100%; max-width: 900px;">
                            <div class="d-flex align-items-center mb-3">
                                <h3 class="text-center flex-grow-1 m-0">Informações das reservas</h3>
                            </div>
                            <!-- Linha com sombra sem espaço nas laterais -->
                            <div class="shadow-sm mb-3" style="height: 1px; background-color: #ddd; width: 100%;"></div>
                            <!-- Linha sem margem -->
                            <div class="d-flex align-items-center mb-3">
                                <h5>ID Reserva: {{ $reservation->id }}</h5>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <strong>Sala:</strong> {{ $reservation->room->name }}
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <h5>Data:</strong> {{ $reservation->reservation_date }}</h5>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <strong>Início reserva:</strong> {{ $reservation->start_time }}
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <strong><strong>Fim reserva:</strong> {{ $reservation->end_time }}</strong>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <strong>Estado:</strong> {{ ucfirst($reservation->status) }}
                            </div>

                            <div class="d-flex align-items-center mb-3">
                                @if ($reservation->status === 'pending')
                                    <div class="alert alert-warning">
                                        Essa reserva está pendente de aprovação de um administrador!
                                    </div>
                                @elseif($reservation->status === 'confirmed')
                                    <div class="alert alert-success">
                                        Sua reserva foi confirmada!
                                    </div>
                                @elseif($reservation->status === 'rejected')
                                    <div class="alert alert-danger">
                                        Sua reserva foi rejeitada!
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
