<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Exibe o formulário de login.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');  // Retorna a view de login
    }

    /**
     * Processa o login do usuário.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // Valida os dados de login (email e senha)
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Tenta autenticar o usuário
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // Redireciona o usuário para a página original que estava tentando acessar ou para a página inicial
            return redirect()->intended('home');
        }

        // Se falhar, redireciona de volta para o formulário de login com erro
        throw ValidationException::withMessages([
            'email' => ['As credenciais fornecidas não são válidas.'],
        ]);
    }

    /**
     * Desfaz a autenticação do usuário (faz o logout).
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        // Realiza o logout do usuário
        Auth::logout();

        // Redireciona para a página de login ou home
        return redirect()->route('login');
    }
}
