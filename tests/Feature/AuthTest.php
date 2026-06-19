<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_com_sucesso(): void
    {
        User::create([
            'nome' => 'Administrador',
            'login' => 'admin',
            'password' => bcrypt('123'),
            'situacao' => 'A'
        ]);

        $response = $this->post('/login', [
            'login' => 'admin',
            'senha' => '123'
        ]);

        $response->assertRedirect('/receitas');

        $this->assertAuthenticated();
    }

    public function test_login_invalido(): void
    {
        $response = $this->post('/login', [
            'login' => 'admin',
            'senha' => 'errada'
        ]);

        $response->assertSessionHas('erro');
    }

    public function test_logout(): void
    {
        $user = User::create([
            'nome' => 'Administrador',
            'login' => 'admin',
            'password' => bcrypt('123'),
            'situacao' => 'A'
        ]);

        $response = $this
            ->actingAs($user)
            ->post('/logout');

        $response->assertRedirect('/');

        $this->assertGuest();
    }
}