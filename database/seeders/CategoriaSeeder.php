<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            'Flores Naturais',
            'Plantas Ornamentais',
            'Vasos e Cachepôs',
            'Adubos e Insumos',
        ];

        foreach ($categorias as $categoria) {
            Categoria::create(['nome' => $categoria]);
        }
    }
}