@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <h1 id="viewUsersTitle">Lista de Reservas</h1>
        <div class="table-container">
            <table id="keywords" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="width: 15%"><span>Local</span></th>
                        <th><span>Sala</span></th>
                        <th><span>Início reserva</span></th>
                        <th><span>Fim reserva</span></th>
                        <th><span>Estado</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->locals_name ?? 'Sem Local' }}</td>
                            <td>{{ $reservation->rooms_name ?? 'Sem Sala' }}</td>
                            <td>{{ $reservation->start_time }}</td>
                            <td>{{ $reservation->end_time }}</td>
                            <td>{{ ucfirst($reservation->status) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($reservations->isEmpty())
            <div class="alert alert-warning">Nenhuma reserva encontrada!</div>
        @endif

        <!-- Paginação -->
        <nav aria-label="Page navigation example" id="pagination">
            <ul class="pagination justify-content-center custom-pagination">
                <li class="page-item {{ $reservations->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $reservations->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @foreach ($reservations->getUrlRange(1, $reservations->lastPage()) as $page => $url)
                    <li class="page-item {{ $reservations->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ !$reservations->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $reservations->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
