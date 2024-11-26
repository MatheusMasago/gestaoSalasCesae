@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    {{--     <div class="position-absolute top-0 start-0">
                <img src="{{ asset('images/background1.png') }}" width="300" height="290" alt="">
            </div> --}}
    <div class="container">
        @auth
            @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                <a href="{{ route('rooms.create') }}" id="newUser">
                    <i class="fas fa-plus"></i>Adicionar sala</a>
            @endif
        @endauth
        <h1 id="viewUsersTitle">Lista de Salas</h1>
        <div class="table-container">
            <table id="keywords" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="width: 20%"><span>Nome</span></th>
                        <th><span>Capacidade</span></th>
                        <th><span>Local</span></th>
                        <th><span>Ações</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rooms as $room)
                        <tr>
                            <td class="lalign">{{ $room->name }}</td>
                            <td>{{ $room->capacity }}</td>
                            <td>{{ $room->local->name }}</td>
                            <td>
                                <!-- Ícone de Ver -->
                                <a href="{{ route('rooms.show', $room->id) }}" title="Ver">
                                    <i class="fas fa-eye action-icon view"></i>
                                </a>
                                @auth
                                    @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                                        <!-- Ícone de Editar -->
                                        <a href="{{ route('rooms.edit', $room->id) }}" title="Editar">
                                            <i class="fas fa-edit action-icon edit"></i>
                                        </a>

                                        <!-- Ícone de Excluir -->
                                        <form action="{{ route('rooms.destroy', $room->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Tem certeza que deseja excluir esta sala?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" style="border: none; background: transparent; padding: 0;">
                                                <i class="fas fa-trash action-icon delete" title="Excluir"></i>
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($rooms->isEmpty())
            <div class="alert alert-warning">Nenhum sala encontrada!</div>
        @endif

        <!-- Paginação -->
        <nav aria-label="Page navigation example" id="pagination">
            <ul class="pagination justify-content-center custom-pagination">
                <li class="page-item {{ $rooms->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $rooms->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @foreach ($rooms->getUrlRange(1, $rooms->lastPage()) as $page => $url)
                    <li class="page-item {{ $rooms->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ !$rooms->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $rooms->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
        {{--         <div class="position-absolute bottom-0 end-0">
            <img src="{{ asset('images/background2.png') }}" width="390" height="350" alt="">
        </div> --}}
    </div>
@endsection
