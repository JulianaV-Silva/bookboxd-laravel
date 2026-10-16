@extends('layouts.app')

@section('content')

    <div class="auth-container">

        <h1>Criar Conta</h1>

        @if ($errors->any())
            <div class="mensagem-erro">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="auth-form">

            @csrf

            <div class="campo-form">
                <label for="name">Nome</label>

                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            </div>

            <div class="campo-form">
                <label for="username">Nome de usuário</label>

                <input type="text" id="username" name="username" value="{{ old('username') }}" maxlength="50" required>
            </div>

            <div class="campo-form">
                <label for="foto">Foto de perfil</label>

                <input type="file" id="foto" name="foto" accept=".jpg,.jpeg,.png">
            </div>

            <div class="campo-form">
                <label for="email">Email</label>

                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="campo-form">
                <label for="password">Senha</label>

                <input type="password" id="password" name="password" required>
            </div>

            <div class="campo-form">
                <label for="password_confirmation">Confirmar senha</label>

                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <button type="submit">
                Criar conta
            </button>

        </form>

        <p class="auth-link">
            Já tem uma conta?
            <a href="{{ route('login') }}">Entrar</a>
        </p>

    </div>

@endsection