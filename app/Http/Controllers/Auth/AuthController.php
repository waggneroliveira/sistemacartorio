<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $credentials['active'] = 1;

        if (!Auth::attempt($credentials)) {
            $user = User::where('email', $request->email)->active()->first();

            if (!$user) {
                return back()->withErrors([
                    'email' => 'E-mail inválido ou usuário inativo.',
                ]);
            }

            if (!Hash::check($request->password, $user->password)) {
                return back()->withErrors([
                    'password' => 'Senha inválida.',
                ]);
            }
        }

        $userAuthenticate = Auth::user();
        $user = User::find($userAuthenticate->id);

        if (!$user->hasRole('Super')) {            
            activity()
            ->causedBy(Auth::user())
            ->performedOn($user)
            ->event('login')
            ->withProperties([
                'attributes' => [
                    'id' => $userAuthenticate->id,
                    'name' => $userAuthenticate->name,
                    'email' => $userAuthenticate->email,
                    'active' => $userAuthenticate->active,
                    'path_image' => $userAuthenticate->path_image,
                    'remember_token' => $userAuthenticate->remember_token,
                    'email_verified_at' => $userAuthenticate->email_verified_at,
                    'event' => 'login',
                ]
            ])
            ->log('login');
        }
          
        session()->flash('success', 'Login realizado com sucesso!');

        return redirect()->intended('painel/dashboard');
    }


    public function logout(Request $request)
    {
        $userAuthenticate = Auth::user(); 
        $user = User::select('id','name','email')->find($userAuthenticate->id);
        
        if (!$user->hasRole('Super')) { 
            activity()
            ->causedBy($userAuthenticate)
            ->performedOn($user)
            ->event('logout')
            ->withProperties([
                'attributes' => [
                    'id' => $userAuthenticate->id,
                    'name' => $userAuthenticate->name,
                    'email' => $userAuthenticate->email,
                    'event' => 'logout',
                ]
            ])
            ->log('logout');
        }
        Auth::guard('web')->logout();

        session()->flash('success', 'Logout realizado com sucesso!');
        return redirect('/painel/success-logout');
    }
}
