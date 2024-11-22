@extends('layouts.main_layout')

@section('content')

<img id="backgroundTop" width="270px" height="300px" src="{{asset('images/background1.png')}}" alt="">
 @guest


<div class="position-absolute top-50 start-50 translate-middle">

    <h3 style="margin-bottom: 5%">Registre-se</h3>
    <form style="display: flex; flex-direction: column; gap: 10px; max-width: 300px;" method="POST" action="{{route('go_to_home')}}">

    <label for="name"></label>
    <input type="string" name="name" id="name" placeholder="Digite seu nome">

    <label for="email"></label>
    <input type="email" name="email" id="email" placeholder="Digite seu email">

    <label for="password"></label>
    <input type="password" name="password" id="password" placeholder="Digite sua senha">

    <button type="submit" id="btnRegister" class="btn btn-outline-primary">Login</button>
    @endguest

    @auth
    <form method="POST" action="{{route('logout')}}"></form>
    <button type="button" class="btn btn-outline-primary">Primary</button>
    @endauth
    </form>
</div>
<div class="position-absolute bottom-0 end-0">
    <img src="{{asset('images/background2.png')}}"  width="270px" height="300px" alt="">
</div>

@endsection
