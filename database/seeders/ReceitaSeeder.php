<?php

namespace Database\Seeders;

use App\Models\Receita;
use Illuminate\Database\Seeder;

class ReceitaSeeder extends Seeder
{
    public function run(): void
    {
        Receita::insert([

            [
                'nome' => 'Bolo de Chocolate',
                'descricao' => 'Bolo simples de chocolate.',
                'data_registro' => now(),
                'custo' => 25.50,
                'tipo_receita' => 'Doce',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Pudim',
                'descricao' => 'Pudim de leite condensado.',
                'data_registro' => now(),
                'custo' => 18.90,
                'tipo_receita' => 'Doce',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Lasanha',
                'descricao' => 'Lasanha à bolonhesa.',
                'data_registro' => now(),
                'custo' => 42.00,
                'tipo_receita' => 'Salgado',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Pizza Calabresa',
                'descricao' => 'Pizza tradicional.',
                'data_registro' => now(),
                'custo' => 55.00,
                'tipo_receita' => 'Salgado',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Torta de Frango',
                'descricao' => 'Torta salgada recheada.',
                'data_registro' => now(),
                'custo' => 32.00,
                'tipo_receita' => 'Salgado',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Mousse de Maracujá',
                'descricao' => 'Sobremesa gelada.',
                'data_registro' => now(),
                'custo' => 14.50,
                'tipo_receita' => 'Doce',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Brigadeiro',
                'descricao' => 'Doce tradicional brasileiro.',
                'data_registro' => now(),
                'custo' => 8.00,
                'tipo_receita' => 'Doce',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Risoto de Frango',
                'descricao' => 'Risoto cremoso.',
                'data_registro' => now(),
                'custo' => 29.90,
                'tipo_receita' => 'Salgado',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Panqueca',
                'descricao' => 'Panqueca recheada.',
                'data_registro' => now(),
                'custo' => 21.00,
                'tipo_receita' => 'Salgado',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'nome' => 'Cheesecake',
                'descricao' => 'Sobremesa cremosa.',
                'data_registro' => now(),
                'custo' => 35.00,
                'tipo_receita' => 'Doce',
                'created_at' => now(),
                'updated_at' => now(),
            ]

        ]);
    }
}