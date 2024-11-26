@extends('layouts.app')

@section('title', 'CESAE Book Space')
@section('content')
    <div class="container">
        <a href="{{ route('users.index') }}" id="newUser">
            <i class="fas fa-plus"></i>Voltar para lista de usuários</a>

        <h1 id="viewUsersTitle">Detalhes do Usuário</h1>
        <div class="table-container">
            <table id="keywords" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th style="width: 15%"><span>Nome</span></th>
                        <th><span>Email</span></th>
                        <th><span>Tipo de usuário</span></th>
                        <th><span>Data de criação</span></th>
                        <th><span>Última atualização</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="lalign">{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->user_type }}</td>
                        <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
