@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    {{--     <div class="position-absolute top-0 start-0">
                <img src="{{ asset('images/background1.png') }}" width="300" height="290" alt="">
            </div> --}}
    <div class="container">
        <h1 id="viewUsersTitle">Estatística de Reservas</h1>
        <div class="table-container">
            <table id="keywords" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="width: 30%"><span>Mês</span></th>
                        <th><span>Total de Reservas</span></th>
                        <th><span>Total de Horas</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stats as $stat)
                        <tr>
                            <td class="lalign">{{ $stat->month }}</td>
                            <td>{{ $stat->reservations_count }}</td>
                            <td>{{ $stat->total_hours }} horas</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($stats->isEmpty())
            <div class="alert alert-warning">Nenhum estatística encontrada!</div>
        @endif
        {{--         <div class="position-absolute bottom-0 end-0">
            <img src="{{ asset('images/background2.png') }}" width="390" height="350" alt="">
        </div> --}}
    </div>
@endsection
