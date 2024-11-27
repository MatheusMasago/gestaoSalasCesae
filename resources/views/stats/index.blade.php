@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')
    <div class="container">
        <h1 id="viewUsersTitle">Estatística de Reservas</h1>
        <div class="table-container">
            <table id="keywords" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="width: 20%"><span>Data</span></th>
                        <th style="width: 20%"><span>Local</span></th>
                        <th><span>Sala</span></th>
                        <th><span>Total de Reservas</span></th>
                        <th style="width: 25%"><span>Total de Horas Reservadas</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stats as $stat)
                        <tr>
                            <td>{{ $stat->full_date }}</td> <!-- Data Completa "YYYY-MM-DD" -->
                            <td>{{ $stat->local_name }}</td> <!-- Nome do Local -->
                            <td>{{ $stat->room_name }}</td> <!-- Nome da Sala -->
                            <td>{{ $stat->reservations_count }}</td> <!-- Número de Reservas -->
                            <td>{{ number_format($stat->total_hours, 2) }} horas</td> <!-- Total de Horas -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($stats->isEmpty())
            <div class="alert alert-warning">Nenhum estatística encontrada!</div>
        @endif


        <!-- Paginação -->
        <nav aria-label="Page navigation example" id="pagination">
            <ul class="pagination justify-content-center custom-pagination">
                <li class="page-item {{ $stats->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $stats->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @foreach ($stats->getUrlRange(1, $stats->lastPage()) as $page => $url)
                    <li class="page-item {{ $stats->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ !$stats->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $stats->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
