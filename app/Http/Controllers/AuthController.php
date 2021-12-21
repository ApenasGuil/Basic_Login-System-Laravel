<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) { // Verificação no DB, para ver se os dados enviados pelo form 'login' batem
            return redirect()->route('form.system');
        };

        return redirect()->route('logout.do'); // Caso as credenciais estejam erradas, redirecionado ao logout e por sua vez, à tela de login
    }

    public function check() // Apenas uma checagem visual sobre o usuário atualmente logado
    {
        if (Auth::check() == true)
            echo "Usuário logado: " . Auth::user()->name;
        else {
            dd('Nenhum usuário logado.');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Deslogando usuário e apagando as sessões do navegador e redirecionando à tela de login
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('form.login');
    }
}
