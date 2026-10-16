@extends('layouts.app')
@section('content')

    <div class="form-livro-container">
        <h1>Editar Livro</h1>

        @if ($errors->any())
            <div class="mensagem-erro">
                <ul>
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form method="POST" action="{{ route('livros.update', $livro->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!--Titulo-->
            <div class="campo-form">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $livro->titulo) }}" required>
            </div>
            <!--Autor-->
            <div class="campo-form">
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" value="{{ old('autor', $livro->autor) }}" required>
            </div>
            <!--Genero-->
            <div class="campo-form">
                <label for="genero">Gênero:</label>
                <input type="text" id="genero" name="genero" value="{{ old('genero', $livro->genero) }}" required>
            </div>
            <!--Nota-->
            <div class="campo-form">
                <label for="nota">Nota:</label>
                <input type="number" id="nota" name="nota" min="1" max="5" value="{{ old('nota', $livro->nota) }}" required>
            </div>
            <!--Crítica-->
            <div class="campo-form">
                <label for="critica">Crítica:</label>
                <textarea id="critica" name="critica" maxlength="500">{{ old('critica', $livro->critica) }}</textarea>
            </div>
            <!--Arquivo-->

            <div class="campo-form">
                <label>Capa atual</label>

                <img class="capa-atual" src="{{ asset('uploads/' . $livro->arquivo) }}" alt="Capa de {{ $livro->titulo }}">
            </div>

            <div class="campo-form">
                <label for="arquivo">Trocar capa</label>
                <input type="file" id="arquivo" name="arquivo" accept=".jpg,.jpeg,.png">
            </div>

            <!--Botão de envio-->
            <button type="submit">Atualizar</button>
        </form>
    </div>
@endsection