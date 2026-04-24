<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('marca_fornecedor');
            $table->string('modelo_tipo');
            $table->foreignId('categoria_id')->constrained('categorias');
            $table->text('descricao')->nullable();
            $table->text('caracteristicas')->nullable();
            $table->integer('quantidade_atual')->default(0);
            $table->integer('estoque_minimo');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};