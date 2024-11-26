@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        {{--     <div class="position-absolute top-0 start-0">
                <img src="{{ asset('images/background1.png') }}" width="300" height="290" alt="">
            </div> --}}
        @auth
            @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                <a href="{{ route('courses.create') }}" id="newUser">
                    <i class="fas fa-plus"></i>Adicionar curso</a>
            @endif
        @endauth
        <h1 id="viewUsersTitle">Lista de Cursos</h1>
        <div class="table-container">
            <table id="keywords" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="width: 40%"><span>Nome</span></th>
                        <th><span>Quantidade</span></th>
                        <th><span>Responsável</span></th>
                        <th><span>Ações</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($courses as $course)
                        <tr>
                            <td class="lalign">{{ $course->name }}</td>
                            @if ($course->quantity_places)
                                <td>{{ $course->quantity_places }}</td>
                            @else
                                <td>0</td>
                            @endif
                            @if ($course->user)
                                <td>User Name: {{ $course->user->name }}</td>
                            @else
                                <td>User not assigned</td>
                            @endif

                            <td>
                                <!-- Ícone de Ver -->
                                <a href="{{ route('courses.show', $course->id) }}" title="Ver">
                                    <i class="fas fa-eye action-icon view"></i>
                                </a>
                                @auth
                                    @if (Auth::user()->user_type == App\Models\User::TYPE_ADMIN)
                                        <!-- Ícone de Editar -->
                                        <a href="{{ route('courses.edit', $course->id) }}" title="Editar">
                                            <i class="fas fa-edit action-icon edit"></i>
                                        </a>

                                        <!-- Ícone de Excluir -->
                                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST"
                                            class="d-inline-block"
                                            onsubmit="return confirm('Tem certeza que deseja excluir este curso?');">
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
        @if ($courses->isEmpty())
            <div class="alert alert-warning">Nenhum curso encontrado.</div>
        @endif

        <!-- Paginação -->
        <nav aria-label="Page navigation example" id="pagination">
            <ul class="pagination justify-content-center custom-pagination">
                <li class="page-item {{ $courses->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $courses->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                    <li class="page-item {{ $courses->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ !$courses->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $courses->nextPageUrl() }}" aria-label="Next">
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
