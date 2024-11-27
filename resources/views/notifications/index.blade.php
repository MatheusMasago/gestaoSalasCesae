@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')

    <div class="container">
        <h1 id="viewUsersTitle">Notificações Recentes</h1>
        <div class="table-container">
            <table id="keywords" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="width: 40%"><span>Mensagem</span></th>
                        <th><span>Usuário</span></th>
                        <th><span>Email</span></th>
                        <th style="width: 20%"><span>Data</span></th>
                        <th><span>Gerenciar</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($notifications as $notification)
                        <tr>
                            <td class="lalign">{{ $notification->data['message'] }}</td>
                            <td>{{ $notification->data['user_name'] ?? 'N/A' }}</td>
                            <td>{{ $notification->data['user_email'] ?? 'N/A' }}</td>
                            <td>{{ $notification->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('notifications.read', $notification->id) }}">
                                    <i class="fa fa-check" style="color: #B00020"></i>
                                </a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($notifications->isEmpty())
            <div class="alert alert-warning">Nenhum estatística encontrada!</div>
        @endif

        <!-- Paginação -->
        <nav aria-label="Page navigation example" id="pagination">
            <ul class="pagination justify-content-center custom-pagination">
                <li class="page-item {{ $notifications->onFirstPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $notifications->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                @foreach ($notifications->getUrlRange(1, $notifications->lastPage()) as $page => $url)
                    <li class="page-item {{ $notifications->currentPage() == $page ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                <li class="page-item {{ !$notifications->hasMorePages() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $notifications->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
