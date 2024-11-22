@extends('layouts.main_layout')
@section('content')
    <div id="feedback-form">
        <h2>Login</h2>
        <div>
            <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data" class="needs-validation"
                novalidate="" autocomplete="off">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="" class="form-control" required="">
                    <div class="invalid-feedback">
                        Email inválido!
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input id="password" type="password" name="password" value="" class="form-control"
                        required="">
                    <a href="{{-- {{ route('password.request') }} --}}" class="float-end" style="margin-top: -1em; color:#c9a763">
                        Esqueceu a senha?
                    </a>
                    <div class="invalid-feedback">
                        Senha inválida!
                    </div>
                    <div class="form-group" style="margin-top: 3em">
                        <p>Não tem conta? <a href="{{ route('user.register') }}" style="color:#c9a763;">Registe-se</a>.</p>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 16em; margin-top:3.5em">
                    Salvar
                </button>
            </form>
        </div>
    </div>
@endsection
