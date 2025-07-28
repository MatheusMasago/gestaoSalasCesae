<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Validator;
use App\Notifications\NewUserNeedsRoleNotification;

class RegisterController extends Controller
{
    /**
     * Exibe o formulário de registro.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register');  // Retorna a view do formulário de registro
    }

    /**
     * Processa o registro de um novo usuário.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(Request $request)
    {
        set_time_limit(40);  // 60 segundos

        // Valida os dados de entrada (nome, email, senha)
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Cria um novo usuário no banco de dados
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make($validated['password']),
        ]);

        // Disparar o evento de registro e enviar o e-mail de verificação
        event(new Registered($user));

        // Notificar os administradores sobre o novo usuário
        $admins = User::where('user_type', User::TYPE_ADMIN)->get();
        foreach ($admins as $admin) {
            // Verifica se a notificação já foi enviada antes de enviá-la novamente
            $existingNotification = $admin->notifications()->where('data->user_email', $user->email)->first();

            if (!$existingNotification) {
                $admin->notify(new NewUserNeedsRoleNotification($user));
            }
            sleep(2);
        }

        // Dispara o evento de registro e envia o e-mail de verificação
        event(new Registered($user));

        // Obtém o último usuário criado
        $lastUser = User::latest()->first();  // Recupera o último usuário criado

        // Envia a notificação (e-mail) para o último usuário
        $lastUser->notify(new NewUserNeedsRoleNotification($lastUser));  // Envia a notificação


        // Redirecionar para uma página de sucesso ou instruções
        return redirect()->route('login');
    }

    /**
     * Define para onde o usuário será redirecionado após o registro.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return route('login'); // Redireciona para a página inicial após o registro
    }
}
