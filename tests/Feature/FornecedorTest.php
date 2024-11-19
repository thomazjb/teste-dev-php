<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Fornecedor;
use App\Models\User;

class FornecedorTest extends TestCase
{

    use RefreshDatabase;

    public function test_criar_fornecedor()
    {
        $email = 'test@test.com';
        $pwd = '123456';

        User::factory()->create([
            'email' => $email,
            'password' => $pwd,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Basic ' . base64_encode($email . ':' . $pwd),
        ])->postJson('/api/fornecedores', [
            'nome_fantasia' => 'Vulturnus Tech',
            'razao_social' => 'THOMAZ JULIANN BONCOMPAGNI',
            'cnpj' => '19131243000197',
            'email' => 'teste@teste.com',
            'telefone' => '419999999',
            'endereco' => 'RUA DAS MARAVILHAS, 123, CENTRO, CURITIBA/PR',
        ]);

        $response->assertStatus(201)
            ->assertJsonFragment(['nome_fantasia' => 'Vulturnus Tech']);
    }

    public function test_criar_fornecedor_com_cnpj_inexistente()
    {

        $response = $this->postJson('/api/fornecedores', [
            'nome_fantasia' => 'Vulturnus Tech',
            'razao_social' => 'THOMAZ JULIANN BONCOMPAGNI',
            'cnpj' => '12345678901234',
        ]);

        $response->assertStatus(401);
    }

    public function test_consultar_cnpj()
    {

        $email = 'test@test.com';
        $pwd = '123456';

        User::factory()->create([
            'email' => $email,
            'password' => $pwd,
        ]);

        $response = $this->withHeaders([
            'Authorization' => 'Basic ' . base64_encode($email . ':' . $pwd),
        ])->get('/api/fornecedores/buscar/19131243000197');
        $response->assertStatus(200)
            ->assertJsonFragment(['nome_fantasia' => 'REDE PELO CONHECIMENTO LIVRE']);
    }
}
