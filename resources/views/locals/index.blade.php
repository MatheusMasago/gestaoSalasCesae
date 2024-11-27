@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        @auth
            @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                <a href="{{ route('locals.create') }}" id="newUser">
                    <i class="fas fa-plus"></i>Criar Local</a>
            @endif
        @endauth
        <h1 id="viewUsersTitle">Locais</h1>
        <div class="table-container">
            <table id="keywords" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="width: 50%"><span>Nome</span></th>
                        <th><span>Ações</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locals as $local)
                        <tr>
                            <td class="lalign">{{ $local->name }}</td>
                            <td>
                                <!-- Ícone de Ver -->
                                <a href="{{ route('locals.show', $local->id) }}" title="Ver">
                                    <i class="fas fa-eye action-icon view"></i>
                                </a>
                                @auth
                                    @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                                        <!-- Ícone de Editar -->
                                        <a href="{{ route('locals.edit', $local->id) }}" title="Editar">
                                            <i class="fas fa-edit action-icon edit"></i>
                                        </a>

                                        <!-- Ícone de Excluir -->
                                        <form action="{{ route('locals.destroy', $local->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Tem certeza que deseja excluir este local?');">
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
        @if ($locals->isEmpty())
            <div class="alert alert-warning">Nenhum local encontrado.</div>
        @endif

        <!-- Paginação -->
        <nav aria-label="Page navigation example" id="pagination">
            <ul class="pagination justify-content-center custom-pagination">
                <li class="page-item {{ $locals->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $locals->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @foreach ($locals->getUrlRange(1, $locals->lastPage()) as $page => $url)
                    <li class="page-item {{ $locals->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ !$locals->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $locals->nextPageUrl() }}" aria-label="Next">
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
