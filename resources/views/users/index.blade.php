@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <a href="{{ route('users.create') }}" id="newUser">
            <i class="fas fa-plus"></i>Criar Usuário
        </a>
        <h1 id="viewUsersTitle">Gerenciamento de Usuários</h1>

        <!-- Container da tabela para permitir rolagem horizontal -->
        <div class="table-container">
            <table id="keywords" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th><span>ID</span></th>
                        <th><span>Nome</span></th>
                        <th><span>Email</span></th>
                        <th><span>Tipo</span></th>
                        <th><span>Ações</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="lalign">{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->user_type }}</td>
                            <td>
                                <!-- Ícone de Ver -->
                                <a href="{{ route('users.show', $user) }}" title="Ver">
                                    <i class="fas fa-eye action-icon view"></i>
                                </a>

                                <!-- Ícone de Editar -->
                                <a href="{{ route('users.edit', $user) }}" title="Editar">
                                    <i class="fas fa-edit action-icon edit"></i>
                                </a>

                                <!-- Ícone de Excluir -->
                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline-block"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este usuário?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="border: none; background: transparent; padding: 0;">
                                        <i class="fas fa-trash action-icon delete" title="Excluir"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if ($users->isEmpty())
            <div class="alert alert-warning">Nenhum usuário encontrado.</div>
        @endif

        <!-- Paginação -->
        <nav aria-label="Page navigation example" id="pagination">
            <ul class="pagination justify-content-center custom-pagination">
                <li class="page-item {{ $users->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                    <li class="page-item {{ $users->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ !$users->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

@endsection
