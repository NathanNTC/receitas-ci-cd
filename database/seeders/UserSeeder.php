<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'nome' => 'adm',
            'login' => 'adm',
            'password' => bcrypt('123'),
            'situacao' => 'A',
        ]);
    }
}
