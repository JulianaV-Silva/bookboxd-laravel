<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_livros', function (Blueprint $table) {
            // Chave primária
            $table->id();
            // Usuário responsável pelo cadastro do livro
            $table->foreignId('user_id')->constrained('users');
            //Dados do livro
            $table->string('titulo', 255);
            $table->string('autor', 100);
            $table->string('genero', 100);
            $table->integer('nota');
            $table->string('critica', 500)->nullable();
            // Nome do arquivo da capa
            $table->string('arquivo', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_livros');
    }
};
