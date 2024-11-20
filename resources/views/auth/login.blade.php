@extends('util.master')

@section('content')
<div class="position-absolute top-50 start-0 translate-middle-y">
    <img src="{{asset('images/logo_cesae-cores_horizontal.png')}}" width="400" height="290" alt="">
 </div>
<div >
    <img src="{{asset('images/background1.png')}}" width="300" height="290" alt="">
</div>


<div class="position-absolute top-50 start-50 translate-middle">
 <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <h4>Login</h4>

    <form method="POST" action="{{ route('dashboard') }}">
        @csrf

        <!-- Email Add  ress -->
        <div class="mt-4" x-data>
            <x-input-label for="email" value="" />
            <x-text-input id="email" placeholder="Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4" x-data>
            <x-input-label for="password"  value="" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"

                            placeholder=Senha
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <!-- Remember Me -->
        <div class="mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>
        <button type="button" type="submit" class="btn btn-outline-primary">Login</button>
        </div>
    </form>
</div>
<div  class="position-absolute bottom-0 end-0">
        <img src="{{asset('images/background2.png')}}"  width="300" height="300" alt="">
</div>

@endsection
