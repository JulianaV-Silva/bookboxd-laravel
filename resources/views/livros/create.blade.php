@extends('layouts.app')

@section('content')
    <div class="form-livro-container">
        <h1>Adicionar Livro</h1>

        @if ($errors->any())
            <div class="mensagem-erro">
                <ul>
                    @foreach ($errors->all() as $erro)
                        <li>{{ $erro }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <!--Conecta o formulário à rota livros.store-->
        <form method="POST" action="{{ route('livros.store') }}" enctype="multipart/form-data">
            @csrf

            <!--Titulo-->
            <div class="campo-form">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
            </div>
            <!--Autor-->
            <div class="campo-form">
                <label for="autor">Autor:</label>
                <input type="text" id="autor" name="autor" value="{{ old('autor') }}" required>
            </div>
            <!--Genero-->
            <div class="campo-form">
                <label for="genero">Gênero:</label>
                <input type="text" id="genero" name="genero" value="{{ old('genero') }}" required>
            </div>
            <!--Nota-->
            <div class="campo-form">
                <label for="nota">Nota:</label>
                <input type="number" id="nota" name="nota" min="1" max="5" value="{{ old('nota') }}" required>
            </div>
            <!--Crítica-->
            <div class="campo-form">
                <label for="critica">Crítica:</label>
                <textarea id="critica" name="critica" maxlength="500">{{ old('critica') }}</textarea>
            </div>
            <!--Arquivo-->
            <div class="campo-form">
                <label for="arquivo">Arquivo:</label>
                <input type="file" id="arquivo" name="arquivo" accept=".jpg,.jpeg,.png" required>
            </div>
            <!--Botão de envio-->
            <button type="submit">Adicionar Livro</button>
        </form>
    </div>
@endsection