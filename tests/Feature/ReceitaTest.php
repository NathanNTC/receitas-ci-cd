<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Receita;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReceitaTest extends TestCase
{
    use RefreshDatabase;

    private function usuario()
    {
        return User::create([
            'nome' => 'Administrador',
            'login' => 'admin',
            'password' => bcrypt('123'),
            'situacao' => 'A'
        ]);
    }

    public function test_listar_receitas()
    {
        $user = $this->usuario();

        Receita::create([
            'nome' => 'Bolo',
            'descricao' => 'Teste',
            'data_registro' => now(),
            'custo' => 10,
            'tipo_receita' => 'Doce'
        ]);

        $response = $this
            ->actingAs($user)
            ->get('/receitas');

        $response->assertStatus(200);
    }

    public function test_criar_receita()
    {
        $user = $this->usuario();

        $response = $this
            ->actingAs($user)
            ->post('/receitas', [
                'nome' => 'Bolo',
                'descricao' => 'Teste',
                'data_registro' => now(),
                'custo' => 10,
                'tipo_receita' => 'Doce'
            ]);

        $response->assertRedirect('/receitas');
        // $response->assertRedirect('/pagina-inexistente');
            
        $this->assertDatabaseHas('receitas', [
            'nome' => 'Bolo'
        ]);
    }

    public function test_validacao_receita()
    {
        $user = $this->usuario();

        $response = $this
            ->actingAs($user)
            ->post('/receitas', []);

        $response->assertSessionHasErrors();
    }

    public function test_editar_receita()
    {
        $user = $this->usuario();

        $receita = Receita::create([
            'nome' => 'Bolo',
            'descricao' => 'Teste',
            'data_registro' => now(),
            'custo' => 10,
            'tipo_receita' => 'Doce'
        ]);

        $response = $this
            ->actingAs($user)
            ->put('/receitas/'.$receita->id, [
                'nome' => 'Bolo Novo',
                'descricao' => 'Teste',
                'data_registro' => now(),
                'custo' => 15,
                'tipo_receita' => 'Doce'
            ]);

        $response->assertRedirect('/receitas');
    }

    public function test_excluir_receita()
    {
        $user = $this->usuario();

        $receita = Receita::create([
            'nome' => 'Bolo',
            'descricao' => 'Teste',
            'data_registro' => now(),
            'custo' => 10,
            'tipo_receita' => 'Doce'
        ]);

        $response = $this
            ->actingAs($user)
            ->delete('/receitas/'.$receita->id);

        $response->assertRedirect('/receitas');
    }

    public function test_rota_protegida()
    {
        $response = $this->get('/receitas');

        $response->assertRedirect('/login');
    }
}