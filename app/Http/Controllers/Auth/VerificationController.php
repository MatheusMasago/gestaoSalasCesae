<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\DatabaseNotification;

class VerificationController extends Controller
{
    /**
     * Redirecionar o usuário após verificar o e-mail.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify(Request $request)
    {
        $user = User::find(Auth::id());

        // Verifique se o link de verificação está correto
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('status', 'Seu e-mail já foi verificado.');
        }

        // Marcar o e-mail como verificado
        $user->markEmailAsVerified();

        // Registrar manualmente a data de verificação
        $user->email_verified_at = Carbon::now();
        $user->save();

        // Disparar o evento de verificação
        event(new Verified($user));

        // Redirecionar o usuário para a página de login
        return redirect()->route('login')->with('status', 'Seu e-mail foi verificado com sucesso. Por favor, faça login.');
    }

    /**
     * Enviar novamente o link de verificação.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resend(Request $request)
    {
        $user = User::find(Auth::id());

        // Verifique se o usuário já verificou o e-mail
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('home');
        }

        // Enviar o link de verificação
        $user->sendEmailVerificationNotification();

        // Redirecionar de volta com uma mensagem de sucesso
        return back()->with('resent', true);
    }

    public function showNotifications()
    {
        if (Auth::check()) {
            $user = Auth::user(); // Obtém o usuário autenticado

            // Recupera as notificações não lidas diretamente da tabela de notificações
            $notifications = DatabaseNotification::where('notifiable_id', $user->id)
                ->whereNull('read_at') // Apenas notificações não lidas
                ->orderBy('created_at', 'desc') // Ordena por data, mais recentes primeiro
                ->paginate(10); // Aplica a paginação

            /* dd($notifications); */

            return view('notifications.index', [
                'notifications' => $notifications,
                'message' => $notifications->isEmpty() ? 'Não há notificações' : null,
            ]);

            return view('notifications.index', compact('notifications'));
        }
    }

    public function markAsRead($notificationId)
    {
        // Verifica se o usuário está autenticado
        if (Auth::check()) {
            // Obtém o usuário autenticado
            $user = User::find(Auth::id());

            // Tenta encontrar a notificação do usuário pelo ID
            // Aqui estamos buscando a notificação do usuário autenticado
            $notification = $user->notifications()->where('id', $notificationId)->first();

            DB::table("notifications")
                ->where("id", $notificationId)
                ->update([
                    "read_at" => now()
                ]);

            // Verifica se a notificação foi encontrada
            if (!$notification) {
                // Se não encontrou, redireciona com uma mensagem de erro
                return redirect()->route('notifications')->with('error', 'Notificação não encontrada.');
            }
            // Redireciona o usuário de volta para a página de notificações com uma mensagem de sucesso
            return redirect()->route('notifications')->with('status', 'Notificação marcada como lida.');
        }
    }
}
