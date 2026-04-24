<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimentacoes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produto_id')->constrained('produtos');
            $table->enum('tipo', ['entrada', 'saida']);
            $table->integer('quantidade');
            $table->string('responsavel')->nullable();
            $table->text('observacao')->nullable();
            $table->integer('quantidade_anterior');
            $table->integer('quantidade_nova');
            $table->timestamps();
            
            $table->index(['produto_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimentacoes');
    }
};