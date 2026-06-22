<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['login' => 'adm'], // Condição para encontrar o registro existente
            [
                'nome' => 'adm',
                'password' => bcrypt('123'),
                'situacao' => 'A',
            ]
        );
    }
}