@extends('layouts.app')

@section('content')

    <div class="livro-detalhes">

        <div class="livro-detalhes-imagem">
            <img src="{{ asset('uploads/' . $livro->arquivo) }}" alt="Capa de {{ $livro->titulo }}">
        </div>

        <div class="livro-detalhes-info">

            <h1>{{ $livro->titulo }}</h1>

            <p class="detalhe-autor">
                {{ $livro->autor }}
            </p>

            <p>
                <strong>Gênero:</strong>
                {{ $livro->genero }}
            </p>

            <div class="estrelas">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $livro->nota)
                        ★
                    @else
                        ☆
                    @endif
                @endfor
            </div>

            @if ($livro->critica)
                <div class="critica-completa">
                    <h2>Crítica</h2>

                    <p>
                        {{ $livro->critica }}
                    </p>
                </div>
            @endif

            @if ($livro->user)
                <p class="detalhe-usuario">
                    Adicionado por
                    {{ $livro->user->username
                ? '@' . $livro->user->username
                : $livro->user->name }}
                </p>
            @endif

            @auth
                @if ($livro->user_id === auth()->id())

                    <div class="acoes-livro">

                        <a href="{{ route('livros.edit', $livro->id) }}" class="btn-editar">
                            Editar
                        </a>

                        <form action="{{ route('livros.destroy', $livro->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn-excluir">
                                Excluir
                            </button>
                        </form>

                    </div>

                @endif
            @endauth
        </div>
    </div>
@endsection