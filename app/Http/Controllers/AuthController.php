<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{   
    // Exibe o formulário de login
   public function showLogin()
    {
        return view('auth.login');
    }
    // Processa o login do usuário
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Regenera a sessão após o login
            $request->session()->regenerate();

            return redirect()->route('livros.index');
        }

        return redirect()->back()
            ->withErrors(['email' => 'Credenciais inválidas.']);
    }
    //Exibe o formulário de cadastro
    public function showRegister()
    {
        return view('auth.register');
    }
    //Cadastra um novo usuário
    public function register(Request $request)
    {
        // Validação dos dados do formulário de cadastro
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $nomeFoto = null;
         // Faz o upload da foto do usuário, se fornecida    
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $nomeFoto = time() . '_' . $foto->getClientOriginalName();
            $foto->move(public_path('imagens/perfis'), $nomeFoto);
        }

        // Criação do usuário no banco
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'foto' => $nomeFoto,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        // Autenticação do usuário recém-registrado
        auth()->login($user);

        $request->session()->regenerate();

       return redirect()->route('livros.index');
    }
    //Encerra a sessão do usuário
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }


}
