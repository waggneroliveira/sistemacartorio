<?php

namespace App\Http\Controllers\Auth;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthClientController extends Controller
{
    public function authenticate(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string'
        ]);
        
        $credentials = $request->only('email', 'password');               
        
        // Tenta autenticar
        if (Auth::guard('client')->attempt($credentials, $request->filled('remember'))) {
            $client = Auth::guard('client')->user();
            
            // ✅ VERIFICAÇÃO DE E-MAIL APENAS PARA PRIMEIRO ACESSO
            // Se o email NÃO foi verificado E o perfil NÃO está completo (primeiro acesso)
            if (!$client->email_verified_at && !$client->profile_completed) {
                Auth::guard('client')->logout();
                return redirect()->route('client.email.pending')
                    ->with('info', 'Por favor, confirme seu e-mail para continuar.');
            }

            // Verifica se o perfil foi completado (apenas se ainda não completou)
            if (!$client->profile_completed) {
                return redirect()->route('complementary-add-on')
                    ->with('info', 'Complete seu cadastro para continuar.');
            }

            session()->flash('success', 'Login realizado com sucesso!');
            return redirect()->route('index');
        }
        
        // Se a autenticação falhou, verifica se o erro é email ou senha
        $client = Client::where('email', $request->email)->first();

        if (!$client) {
            return back()->withErrors([
                'email' => 'E-mail inválido ou não cadastrado.'
            ])->withInput($request->only('email'));
        }

        // Se o email existe mas a senha está errada
        return back()->withErrors([
            'password' => 'Senha inválida.'
            ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();

        session()->flash('success', 'Logout realizado com sucesso!');
        return redirect()->route('login');
    }

}
