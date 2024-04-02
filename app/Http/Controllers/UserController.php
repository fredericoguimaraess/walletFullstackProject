<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); // Exibir formulário de registro
    }

    public function register(Request $request)
    {
        try {
            // Validação dos dados recebidos
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:8|confirmed',
            ]);

            // Crie um novo usuário
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
            ]);

            // Autentique o usuário automaticamente após o registro
            Auth::login($user);
            return redirect('/login');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Senha muito curta');
        }
    }

    public function showLoginForm()
    {
        return view('auth.login'); // Exibir formulário de login
    }

    public function login(Request $request)
    {
        // Lógica para autenticar o usuário
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            // Autenticação bem-sucedida
            return redirect('/dashboard');
        } else {
            // Autenticação falhou
            return redirect()->back()->with('error', 'Credenciais inválidas');
        }
    }
}
