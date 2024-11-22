@extends('layouts.main_layout')

@section('content')

<img id="backgroundTop" width="270px" height="300px" src="{{asset('images/background1.png')}}" alt="">

<div class="position-absolute top-50 start-50 translate-middle">
    <h3 style="margin-bottom: 5%">Login</h3>
    <form  enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 10px; max-width: 300px;" method="POST" action="{{route('login')}}">
        @csrf
    <label for="email"></label>
    <input type="email" name="email" id="email" placeholder="Digite seu email">

    <label for="password"></label>
    <input type="password" name="password" id="password" placeholder="Digite sua senha">

    <a href="{{route('user.register')}}">Não tem conta? Registre-se</a>

    <button type="submit" id="btnLogin" class="btn btn-outline-primary">Login</button>
        {{-- @auth
        <form method="POST" action="{{route('logout')}}"></form>
        <button type="button" class="btn btn-outline-primary">logout</button>
        @endauth --}}
     </form>

</div>
<div class="position-absolute bottom-0 end-0">
    <img src="{{asset('images/background2.png')}}"  width="270px" height="300px" alt="">
</div>

@endsection
