@extends('layouts.app')

@section('content')

    <section class="home-hero">

        <div class="booktok-mosaic">
            <div class="grid">

                <div class="cover c1 r2">
                    <div class="txt">
                        <span class="title">Os Sete Maridos de Evelyn Hugo</span>
                        <span class="author">Taylor Jenkins Reid</span>
                    </div>
                </div>

                <div class="cover c2">
                    <div class="txt">
                        <span class="title">Verity</span>
                        <span class="author">Colleen Hoover</span>
                    </div>
                </div>

                <div class="cover c3 r3">
                    <div class="txt">
                        <span class="title">Trono de Vidro</span>
                        <span class="author">Sarah J. Maas</span>
                    </div>
                </div>

                <div class="cover c4">
                    <div class="txt">
                        <span class="title">A Metamorfose</span>
                        <span class="author">Franz Kafka</span>
                    </div>
                </div>

                <div class="cover c5 r2">
                    <div class="txt">
                        <span class="title">Quarta Asa</span>
                        <span class="author">Rebecca Yarros</span>
                    </div>
                </div>

                <div class="cover c6">
                    <div class="txt">
                        <span class="title">Divinos Rivais</span>
                        <span class="author">Rebecca Ross</span>
                    </div>
                </div>

                <div class="cover c7 r2">
                    <div class="txt">
                        <span class="title">É Assim que Acaba</span>
                        <span class="author">Colleen Hoover</span>
                    </div>
                </div>

                <div class="cover c8">
                    <div class="txt">
                        <span class="title">A Hipótese do Amor</span>
                        <span class="author">Ali Hazelwood</span>
                    </div>
                </div>

                <div class="cover c9 r3">
                    <div class="txt">
                        <span class="title">Corte de Espinhos e Rosas</span>
                        <span class="author">Sarah J. Maas</span>
                    </div>
                </div>

                <div class="cover c10">
                    <div class="txt">
                        <span class="title">Sombra e Ossos</span>
                        <span class="author">Leigh Bardugo</span>
                    </div>
                </div>

                <div class="cover c11 r2">
                    <div class="txt">
                        <span class="title">Orgulho e Preconceito</span>
                        <span class="author">Jane Austen</span>
                    </div>
                </div>

                <div class="cover c12">
                    <div class="txt">
                        <span class="title">Por Onde Cantam os Vagalumes</span>
                        <span class="author">Delia Owens</span>
                    </div>
                </div>

                <div class="cover c4 r2">
                    <div class="txt">
                        <span class="title">Trono de Vidro</span>
                        <span class="author">Sarah J. Maas</span>
                    </div>
                </div>

                <div class="cover c6">
                    <div class="txt">
                        <span class="title">Verity</span>
                        <span class="author">Colleen Hoover</span>
                    </div>
                </div>

                <div class="cover c8 r3">
                    <div class="txt">
                        <span class="title">Quarta Asa</span>
                        <span class="author">Rebecca Yarros</span>
                    </div>
                </div>

                <div class="cover c1">
                    <div class="txt">
                        <span class="title">A Hipótese do Amor</span>
                        <span class="author">Ali Hazelwood</span>
                    </div>
                </div>

                <div class="cover c9 r2">
                    <div class="txt">
                        <span class="title">Sombra e Ossos</span>
                        <span class="author">Leigh Bardugo</span>
                    </div>
                </div>

                <div class="cover c2 r2">
                    <div class="txt">
                        <span class="title">Divinos Rivais</span>
                        <span class="author">Rebecca Ross</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="home-overlay"></div>

        <div class="home-texto">

            <h1>Registre cada livro que passa pela sua estante.</h1>

            <p>
                Registre suas leituras, avalie seus livros
                e descubra o que a comunidade está lendo.
            </p>

            <div class="home-botoes">

                @guest
                    <a class="btn-home-principal" href="{{ route('register') }}">
                        Criar conta
                    </a>
                @endguest

                <a class="btn-home-secundario" href="{{ route('livros.index') }}">
                    Explorar
                </a>

            </div>

        </div>

    </section>
    <section class="home-comunidade">

    <div class="home-secao-titulo">
        <h2>Descubra novas leituras</h2>

        <a href="{{ route('livros.index') }}">
            Ver todos
        </a>
    </div>

    <div class="home-livros-grid">

        @foreach ($livros as $livro)

            <div class="home-livro-card">

                <img
                    src="{{ asset('uploads/' . $livro->arquivo) }}"
                    alt="Capa de {{ $livro->titulo }}"
                >

                <h3>{{ $livro->titulo }}</h3>

                <p>{{ $livro->autor }}</p>

                <div class="estrelas">
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= $livro->nota)
                            ★
                        @else
                            ☆
                        @endif
                    @endfor
                </div>

                @if ($livro->user)
                    <span class="home-usuario">
                        {{ $livro->user->username
                            ? '@' . $livro->user->username
                            : $livro->user->name }}
                    </span>
                @endif

            </div>

        @endforeach

    </div>

</section>

@endsection