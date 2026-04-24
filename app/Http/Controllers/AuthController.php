<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'senha' => 'required|string',
        ]);

        $usuario = Usuario::where('login', $request->login)->first();

        if ($usuario && $usuario->verificarSenha($request->senha)) {
            session(['usuario_id' => $usuario->id, 'usuario_nome' => $usuario->nome]);
            return redirect()->route('dashboard')->with('success', 'Login realizado com sucesso!');
        }

        return back()->withErrors(['credenciais' => 'Login ou senha inválidos!']);
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Logout realizado com sucesso!');
    }
}