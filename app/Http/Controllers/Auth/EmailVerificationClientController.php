<?php

namespace App\Http\Controllers\Auth;

use App\Models\Client;
use App\Models\SettingEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\ResendConfirmationEmailClient;

class EmailVerificationClientController extends Controller
{
    /**
     * Verifica o email através do token
     */
    public function verify(Request $request, $token)
    {
        $client = Client::where('email_verification_token', $token)->first();

        if (!$client) {
            return redirect()->route('login')->with('error', 'Token de verificação inválido ou expirado.');
        }

        // Marca o email como verificado
        $client->update([
            'email_verified_at' => now(),
            'email_verification_token' => null,
            'email_verification_requested_at' => null,
            'active' => 1,
        ]);

        return redirect()->route('login')->with('success', 'E-mail verificado com sucesso! Agora você pode fazer login.');
    }

    /**
     * Exibe a página de verificação de email pendente
     */
    public function pending()
    {
        $client = auth('client')->user();

        if (!$client) {
            return redirect()->route('login');
        }

        if ($client->email_verified_at) {
            return redirect()->route('index');
        }

        return view('client.auth.email-verification-pending', compact('client'));
    }

    /**
     * Reenvia o email de confirmação
     */
    public function resend(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:clients,email',
        ], [
            'email.exists' => 'E-mail não encontrado.',
        ]);

        $client = Client::where('email', $request->email)->first();

        if (!$client) {
            return back()->with('error', 'E-mail não encontrado.');
        }

        if ($client->email_verified_at) {
            return back()->with('info', 'Este e-mail já foi verificado.');
        }

        // Gera um novo token
        $token = Str::random(64);
        
        $client->update([
            'email_verification_token' => $token,
            'email_verification_requested_at' => now(),
        ]);

        try {
            // Configura as credenciais de email
            $emailSettings = SettingEmail::first();
            
            Config::set([
                'mail.default' => $emailSettings->mail_mailer ?? 'smtp',
                'mail.mailers.smtp.transport' => $emailSettings->mail_mailer ?? 'smtp',
                'mail.mailers.smtp.host' => $emailSettings->mail_host ?? 'smtp.gmail.com',
                'mail.mailers.smtp.port' => $emailSettings->mail_port ?? 465,
                'mail.mailers.smtp.encryption' => $emailSettings->mail_encryption ?? 'ssl',
                'mail.mailers.smtp.username' => $emailSettings->mail_username ?? 'waggner.447@gmail.com',
                'mail.mailers.smtp.password' => $emailSettings->mail_password ?? 'aggd cvvg ljkp gxli',
                'mail.from.address' => $emailSettings->mail_from_address ?? 'waggner.447@gmail.com',
                'mail.from.name' => $emailSettings->mail_from_name ?? 'WHI - Web de Alta inspiração',
            ]);

            Mail::to($client->email)->send(new ResendConfirmationEmailClient($client, $token));
            return back()->with('success', 'E-mail de confirmação reenviado com sucesso! Verifique sua caixa de entrada.');
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao enviar e-mail: ' . $e->getMessage());
        }
    }

    /**
     * Mostra o formulário de reenvio de email
     */
    public function showResendForm()
    {
        return view('client.auth.resend-email');
    }
}
