<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Livro;

class LivroController extends Controller
{
    // Lista todos os livros cadastrados no sistema
    // Exibe 5 livros por página
    public function index()
    {
        $livros = Livro::paginate(12);

        return view('livros.index', compact('livros'));
    }


    // Exibe o formulário para cadastrar um novo livro
    public function create()
    {
        return view('livros.create');
    }


    // Recebe os dados do formulário e cadastra o livro
    public function store(Request $request)
    {
        // Valida os dados utilizando as regras definidas no Model Livro
        $request->validate(Livro::$rules);

        $livro = new Livro();

        // Relaciona o livro com o usuário que está logado
        $livro->user_id = auth()->id();

        $livro->titulo = $request->input('titulo');
        $livro->autor = $request->input('autor');
        $livro->genero = $request->input('genero');
        $livro->nota = $request->input('nota');
        $livro->critica = $request->input('critica');

        // Faz o upload da capa do livro
        if ($request->hasFile('arquivo')) {

            $arquivo = $request->file('arquivo');

            // Cria um nome para o arquivo utilizando o horário atual
            $nomeArquivo = time() . '_' . $arquivo->getClientOriginalName();

            // Salva a imagem na pasta public/uploads
            $arquivo->move(public_path('uploads'), $nomeArquivo);

            // Salva apenas o nome do arquivo no banco
            $livro->arquivo = $nomeArquivo;
        }

        $livro->save();

        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro cadastrado com sucesso!');
    }


    // Exibe o formulário para editar um livro
    public function edit($id)
    {
        $livro = Livro::findOrFail($id);

        // Verifica se o livro pertence ao usuário logado
        if ($livro->user_id !== auth()->id()) {

            return redirect()
                ->route('livros.index')
                ->with('error', 'Você não pode editar este livro.');
        }

        return view('livros.edit', compact('livro'));
    }


    // Atualiza os dados de um livro
    public function update(Request $request, $id)
    {
        $livro = Livro::findOrFail($id);

        // Somente o usuário que cadastrou o livro pode alterá-lo
        if ($livro->user_id !== auth()->id()) {

            return redirect()
                ->route('livros.index')
                ->with('error', 'Você não pode atualizar este livro.');
        }

        // Na atualização, a troca da capa é opcional
        $request->validate(Livro::$rulesUpdate);

        $livro->titulo = $request->input('titulo');
        $livro->autor = $request->input('autor');
        $livro->genero = $request->input('genero');
        $livro->nota = $request->input('nota');
        $livro->critica = $request->input('critica');

        // Verifica se o usuário enviou uma nova capa
        if ($request->hasFile('arquivo')) {

            $caminhoArquivoAntigo = public_path('uploads/' . $livro->arquivo);

            // Remove a imagem antiga, caso ela exista
            if ($livro->arquivo && file_exists($caminhoArquivoAntigo)) {
                unlink($caminhoArquivoAntigo);
            }

            // Salva a nova imagem
            $arquivo = $request->file('arquivo');

            $nomeArquivo = time() . '_' . $arquivo->getClientOriginalName();

            $arquivo->move(public_path('uploads'),$nomeArquivo
            );

            $livro->arquivo = $nomeArquivo;
        }

        $livro->save();

        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro atualizado com sucesso!');
    }


    // Exclui um livro
    public function destroy($id)
    {
        $livro = Livro::findOrFail($id);

        // Impede que outro usuário exclua o livro
        if ($livro->user_id !== auth()->id()) {

            return redirect()
                ->route('livros.index')
                ->with('error', 'Você não pode excluir este livro.');
        }

        // Remove a capa armazenada no servidor
        if ($livro->arquivo) {

            $caminhoArquivo = public_path('uploads/' . $livro->arquivo);

            if (file_exists($caminhoArquivo)) {
                unlink($caminhoArquivo);
            }
        }

        // Remove o registro do banco de dados
        $livro->delete();

        return redirect()
            ->route('livros.index')
            ->with('success', 'Livro excluído com sucesso!');
    }


    // Lista somente os livros cadastrados pelo usuário logado
    public function meusLivros()
    {
        $livros = Livro::where('user_id',auth()->id())->paginate(5);

        return view('livros.meus-livros',compact('livros') );
    }


    // Exibe todos os dados de um livro específico
    public function show($id)
    {
        $livro = Livro::findOrFail($id);

        return view('livros.show', compact('livro'));
    }
}