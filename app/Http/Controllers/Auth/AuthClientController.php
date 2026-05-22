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
        $credentials = $request->only('email', 'password');
        
        // Tenta autenticar
        if (!Auth::guard('client')->attempt($credentials)) {
            $client = Client::where('email', $request->email)->first();
            
            dd($credentials);
            if (!$client) {
                session()->flash('error', __('E-mail inválido ou usuário inativo.'));
                return redirect()->back();
            }

            if (!Hash::check($request->password, $client->password)) {
                return back()->withErrors([
                    'password' => 'Senha inválida.',
                ])->withInput();
            }
        }

        $client = Auth::guard('client')->user();
        
        // Verifica se o email foi confirmado
        if (!$client->email_verified_at) {
            Auth::guard('client')->logout();
            return redirect()->route('client.email.pending')
                ->with('info', 'Por favor, confirme seu e-mail para continuar.');
        }

        // Verifica se o perfil foi completado
        if (!$client->profile_completed) {
            return redirect()->route('complementary-add-on')
                ->with('info', 'Complete seu cadastro para continuar.');
        }

        session()->flash('success', 'Login realizado com sucesso!');
        return redirect()->route('index');
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();

        session()->flash('success', 'Logout realizado com sucesso!');
        return redirect()->route('login');
    }

}
