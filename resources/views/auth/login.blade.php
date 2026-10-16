@extends('layouts.app')

@section('content')

<div class="auth-container">

    <h1>Entrar</h1>

    @if ($errors->any())
        <div class="mensagem-erro">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">

        @csrf

        <div class="campo-form">
            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="campo-form">
            <label for="password">Senha</label>

            <input
                type="password"
                id="password"
                name="password"
                required
            >
        </div>

        <button type="submit">
            Entrar
        </button>

    </form>

    <p class="auth-link">
        Ainda não tem uma conta?
        <a href="{{ route('register') }}">Criar conta</a>
    </p>

</div>

@endsection