<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\Categoria;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $categoria1 = Categoria::where('nome', 'Flores Naturais')->first();
        $categoria2 = Categoria::where('nome', 'Plantas Ornamentais')->first();
        $categoria3 = Categoria::where('nome', 'Vasos e Cachepôs')->first();
        $categoria4 = Categoria::where('nome', 'Adubos e Insumos')->first();

        Produto::create([
            'nome' => 'Rosa Vermelha Unidade',
            'marca_fornecedor' => 'Flores do Vale',
            'modelo_tipo' => 'Corte Natural',
            'categoria_id' => $categoria1->id,
            'descricao' => 'Rosa vermelha de alta qualidade, ideal para buquês e arranjos sofisticados',
            'caracteristicas' => 'Cor: Vermelha; Tamanho: 45-50cm; Durabilidade: 7-10 dias',
            'quantidade_atual' => 30,
            'estoque_minimo' => 10,
        ]);

        Produto::create([
            'nome' => 'Orquídea Phalaenopsis',
            'marca_fornecedor' => 'Jardim Real',
            'modelo_tipo' => 'Vaso Médio',
            'categoria_id' => $categoria2->id,
            'descricao' => 'Orquídea com flores brancas em vaso cerâmico, planta resistente',
            'caracteristicas' => 'Cor: Branca; Tamanho: Médio (20-25cm); Vasos por unidade: 1',
            'quantidade_atual' => 5,
            'estoque_minimo' => 3,
        ]);

        Produto::create([
            'nome' => 'Vaso de Cerâmica Branco',
            'marca_fornecedor' => 'Casa Verde',
            'modelo_tipo' => 'Tamanho Médio',
            'categoria_id' => $categoria3->id,
            'descricao' => 'Vaso de cerâmica esmaltada, perfeito para pequenas plantas',
            'caracteristicas' => 'Material: Cerâmica; Cor: Branco; Diâmetro: 15cm; Altura: 12cm',
            'quantidade_atual' => 0,
            'estoque_minimo' => 4,
        ]);

        Produto::create([
            'nome' => 'Buquê de Girassóis',
            'marca_fornecedor' => 'Floratta',
            'modelo_tipo' => 'Arranjo Simples',
            'categoria_id' => $categoria1->id,
            'descricao' => 'Arranjo com girassóis naturais, ideal para presentear',
            'caracteristicas' => 'Composição: 5-7 girassóis; Altura: 35cm; Com embrulho decorativo',
            'quantidade_atual' => 8,
            'estoque_minimo' => 5,
        ]);

        Produto::create([
            'nome' => 'Adubo Orgânico 1kg',
            'marca_fornecedor' => 'Terra Forte',
            'modelo_tipo' => 'Granulado',
            'categoria_id' => $categoria4->id,
            'descricao' => 'Adubo orgânico granulado, rico em nutrientes para melhorar o solo',
            'caracteristicas' => 'Tipo: Orgânico; Apresentação: Granulado; Peso: 1kg; pH: 6.5-7.5',
            'quantidade_atual' => 4,
            'estoque_minimo' => 4,
        ]);
    }
}