@extends('layouts.app')

@section('content')

<h1>Explorar</h1>

<div class="explorar-grid">

    @foreach ($livros as $livro)

        <a href="{{ route('livros.show', $livro->id) }}" class="explorar-card-link">

            <div class="explorar-card">

                <img
                    class="explorar-capa"
                    src="{{ asset('uploads/' . $livro->arquivo) }}"
                    alt="Capa de {{ $livro->titulo }}"
                >

                <h2>{{ $livro->titulo }}</h2>

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

                    <p class="livro-usuario">

                        {{ $livro->user->username
                            ? '@' . $livro->user->username
                            : $livro->user->name }}

                    </p>

                @endif

            </div>

        </a>

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