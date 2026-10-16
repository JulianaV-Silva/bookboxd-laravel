<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Bookboxd</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <header>
        <!--Barra de navegação-->
        <nav class="navbar-bookboxd">

            <a class="logo-bookboxd" href="{{ url('/') }}">
                <img src="{{ asset('imagens/bookboxd_logo.png') }}" alt="Logo Bookboxd">
                <span>BOOKBOXD</span>
            </a>

            <div class="menu-bookboxd">

                <a href="{{ route('livros.index') }}">Explorar</a>

                @auth
                    <a href="{{ route('livros.meus-livros') }}">Meus Livros</a>

                    <a href="{{ route('livros.create') }}">Adicionar livro</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn-sair" type="submit">Sair</button>
                    </form>
                @else
                    <a href="{{ route('login') }}">Entrar</a>

                    <a href="{{ route('register') }}">Criar conta</a>
                @endauth

            </div>

        </nav>
        <!--Informações do usuário logado-->
        @auth
            <div class="usuario-abaixo">

                <img src="{{ auth()->user()->foto
            ? asset('imagens/perfis/' . auth()->user()->foto)
            : asset('imagens/perfis/foto-padrao.png') }}" alt="Foto de perfil" class="foto-perfil">

                <span>{{ auth()->user()->username }}</span>

            </div>
        @endauth

    </header>


    <main>

        @if (session('success'))
            <div class="mensagem-sucesso">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mensagem-erro">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')

    </main>

</body>

</html>