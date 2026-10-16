<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Livro;
use App\Models\User;

class LivroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pega o usuário criado no UserSeeder 
        $usuario = User::where('email', 'dummy@bookboxd.com')->firstOrFail();
        Livro::create([
            'user_id' => $usuario->id,
            'titulo' => 'O Pequeno Príncipe',
            'autor' => 'Antoine de Saint-Exupéry',
            'genero' => 'Fábula',
            'nota' => 5,
            'critica' => 'Uma história linda e profunda sobre amizade, amor e a essência da vida.',
            'arquivo' => 'pequeno_principe.jpg',
        ]);

        Livro::create([
            'user_id' => $usuario->id,
            'titulo' => 'Dom Casmurro',
            'autor' => 'Machado de Assis',
            'genero' => 'Romance',
            'nota' => 5,
            'critica' => 'Um clássico da literatura brasileira.',
            'arquivo' => 'dom_casmurro.jpg',
        ]);

        Livro::create([
            'user_id' => $usuario->id,
            'titulo' => '1984',
            'autor' => 'George Orwell',
            'genero' => 'Distopia',
            'nota' => 5,
            'critica' => 'Uma visão perturbadora de um futuro totalitário.',
            'arquivo' => '1984.jpg',
        ]);
    }
}
