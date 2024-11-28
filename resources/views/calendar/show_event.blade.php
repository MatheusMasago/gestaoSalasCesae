@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <table id="keywords" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Início</th>
                    <th scope="col">Fim</th>

                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reserves as $reserve)
                    <tr>
                        <th scope="row">{{ $reserve->id }}</th>
                        <td>{{ $reserve->start_time }}</td>
                        <td>{{ $reserve->end_time }}</td>
                        <td><a href="{{ route('delete', $reserve->id) }}" class="btn btn-danger">Apagar reserva</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
