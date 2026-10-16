@extends('layouts.app')

@section('content')

    <h1>Meus Livros</h1>

    <div class="livros-grid">

        @foreach ($livros as $livro)

            <div class="livro-card">

                <img class="livro-capa" src="{{ asset('uploads/' . $livro->arquivo) }}" alt="Capa de {{ $livro->titulo }}">

                <div class="livro-info">

                    <h2>{{ $livro->titulo }}</h2>

                    <p class="livro-autor">
                        Autor: {{ $livro->autor }}
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

                    <div class="botoes-livro">
                        <a class="btn-editar" href="{{ route('livros.edit', $livro->id) }}">
                            Editar
                        </a>

                        <form action="{{ route('livros.destroy', $livro->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button class="btn-excluir" type="submit">Excluir</button>
                        </form>
                    </div>
                    
                </div>

            </div>

        @endforeach

    </div>

    @if ($livros->hasPages())

    <div class="paginacao-bookboxd">

        @if (!$livros->onFirstPage())
            <a href="{{ $livros->previousPageUrl() }}">
                ← Anterior
            </a>
        @endif

        <span class="paginacao-atual">
            Página {{ $livros->currentPage() }}
            de {{ $livros->lastPage() }}
        </span>

        @if ($livros->hasMorePages())
            <a href="{{ $livros->nextPageUrl() }}">
                Próxima →
            </a>
        @endif

    </div>

@endif

@endsection