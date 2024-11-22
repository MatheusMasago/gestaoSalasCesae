@extends('layouts.main_layout')

@section('content')
@if (session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
<img id="backgroundTop" width="270px" height="300px" src="{{asset('images/background1.png')}}" alt="">
 @guest


<div class="position-absolute top-50 start-50 translate-middle">

    <h3 style="margin-bottom: 5%">Registre-se</h3>
    <form style="display: flex; flex-direction: column; gap: 10px; max-width: 300px;" enctype="multipart/form-data" method="POST" action="{{route('users.store')}}">
        @csrf

    <label for="name"></label>
    <input type="string" name="name" id="name" placeholder="Digite seu nome">

    <label for="email"></label>
    <input type="email" name="email" id="email" placeholder="Digite seu email">

    <label for="password"></label>
    <input type="password" name="password" id="password" placeholder="Digite sua senha">
        <div class="form-group mb-3">
            <label for="user_type" class="form-label">Tipo de Usuário</label>
            <select name="user_type" id="user_type" class="form-control @error('user_type') is-invalid @enderror"
                required>
                <option value="{{ \App\Models\User::TYPE_ADMIN }}"
                    {{ isset($user) && $user->user_type == \App\Models\User::TYPE_ADMIN ? 'selected' : '' }}>
                    Administrador</option>
                <option value="{{ \App\Models\User::TYPE_MODERATOR }}"
                    {{ isset($user) && $user->user_type == \App\Models\User::TYPE_MODERATOR ? 'selected' : '' }}>
                    Moderador</option>
                <option value="{{ \App\Models\User::TYPE_FORMADOR }}"
                    {{ isset($user) && $user->user_type == \App\Models\User::TYPE_FORMADOR ? 'selected' : '' }}>
                    Formador</option>
            </select>
            @error('user_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    <button type="submit" id="btnRegister" class="btn btn-outline-primary">Registrar</button>
    </form>

    @endguest

    {{-- @auth
    <div class="position-absolute top-50 start-50 translate-middle">
        <h1>{{Auth::user()->name}}</h1>
        <form method="POST" action="{{route('logout')}}"></form>
    <button type="button" class="btn btn-outline-primary">Logout</button>
  </div>
      @endauth --}}
</div>
<div class="position-absolute bottom-0 end-0">
    <img src="{{asset('images/background2.png')}}"  width="270px" height="300px" alt="">
</div>

@endsection
