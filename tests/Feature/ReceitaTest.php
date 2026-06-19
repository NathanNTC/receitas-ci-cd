<?php

namespace Tests\Feature;

use App\Models\Receita;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReceitaTest extends TestCase
{
    use RefreshDatabase;

    private function usuario()
    {
        return User::create([
            'nome' => 'Administrador',
            'login' => 'admin',
            'password' => bcrypt('123'),
            'situacao' => 'A',
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
            'tipo_receita' => 'Doce',
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
                'tipo_receita' => 'Doce',
            ]);

        $response->assertRedirect('/receitas');

        $this->assertDatabaseHas('receitas', [
            'nome' => 'Bolo',
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
            'tipo_receita' => 'Doce',
        ]);

        $response = $this
            ->actingAs($user)
            ->put('/receitas/'.$receita->id, [
                'nome' => 'Bolo Novo',
                'descricao' => 'Teste',
                'data_registro' => now(),
                'custo' => 15,
                'tipo_receita' => 'Doce',
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
            'tipo_receita' => 'Doce',
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

    // ==============================
    // +10 TESTES
    // ==============================

    public function test_criar_receita_sem_login()
    {
        $response = $this->post('/receitas', [
            'nome' => 'Bolo',
        ]);

        $response->assertRedirect('/login');
    }

    public function test_login_senha_incorreta()
    {
        User::create([
            'nome' => 'Admin',
            'login' => 'admin',
            'password' => bcrypt('123'),
            'situacao' => 'A',
        ]);

        $response = $this->post('/login', [
            'login' => 'admin',
            'senha' => 'errada',
        ]);

        $response->assertSessionHas('erro');
        $this->assertGuest();
    }

    public function test_atualizar_receita_inexistente()
    {
        $user = $this->usuario();

        $response = $this->actingAs($user)
            ->put('/receitas/999', [
                'nome' => 'Teste',
            ]);

        $this->assertTrue(
            in_array($response->status(), [302, 404])
        );
    }

    public function test_deletar_receita_inexistente()
    {
        $user = $this->usuario();

        $response = $this->actingAs($user)
            ->delete('/receitas/999');

        $this->assertTrue(
            in_array($response->status(), [302, 404])
        );
    }

    public function test_validacao_nome_obrigatorio()
    {
        $user = $this->usuario();

        $response = $this->actingAs($user)
            ->post('/receitas', [
                'descricao' => 'Teste',
            ]);

        $response->assertSessionHasErrors(['nome']);
    }

    public function test_validacao_custo_invalido()
    {
        $user = $this->usuario();

        $response = $this->actingAs($user)
            ->post('/receitas', [
                'nome' => 'Bolo',
                'custo' => 'abc',
            ]);

        $response->assertSessionHasErrors(['custo']);
    }

    public function test_rota_inexistente()
    {
        $response = $this->get('/rota-que-nao-existe-123');

        $response->assertStatus(404);
    }

    public function test_receita_salva_corretamente()
    {
        $user = $this->usuario();

        $this->actingAs($user)
            ->post('/receitas', [
                'nome' => 'Arroz',
                'descricao' => 'Teste',
                'data_registro' => now(),
                'custo' => 20,
                'tipo_receita' => 'Salgado',
            ]);

        $this->assertDatabaseHas('receitas', [
            'nome' => 'Arroz',
        ]);
    }

    public function test_login_sem_senha()
    {
        $response = $this->post('/login', [
            'login' => 'admin',
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_listagem_sem_dados_na_tabela()
    {
        $user = $this->usuario();

        $response = $this->actingAs($user)
            ->get('/receitas');

        $response->assertStatus(200);
    }
}
