<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        Usuario::create([
            'nome' => 'Administrador',
            'login' => 'admin',
            'senha' => '123',
        ]);

        Usuario::create([
            'nome' => 'Professor',
            'login' => 'prof',
            'senha' => 'qwer',
        ]);
    }
}