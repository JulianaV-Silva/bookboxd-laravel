<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Livro extends Model
{   
    //Nome da tabela no banco de dados
    protected $table = 'tb_livros';

    //Campos da tabela
    protected $fillable = [
        'titulo',
        'autor',
        'genero',
        'nota',
        'critica',
        'arquivo',
        'user_id',
    ];

    //Regras para entrada dos dados
    public static $rules = [
        'titulo' => 'required|string|max:255',
        'autor' => 'required|string|max:100',
        'genero' => 'required|string|max:100',
        'nota' => 'required|integer|min:1|max:5',
        'critica' => 'nullable|string|max:500',
        'arquivo' => 'required|image|mimes:jpeg,jpg,png|max:2048',
    ];
    //Regras para atualização dos dados
    public static $rulesUpdate = [
    'titulo' => 'required|string|max:255',
    'autor' => 'required|string|max:100',
    'genero' => 'required|string|max:100',
    'nota' => 'required|integer|min:1|max:5',
    'critica' => 'nullable|string|max:500',
    'arquivo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}
}
