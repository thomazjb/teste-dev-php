<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Fornecedor;

class FornecedorTest extends TestCase
{

    use RefreshDatabase; 

    public function test_criar_fornecedor()
    {
    
        $response = $this->postJson('/api/fornecedores', [
            'nome_fantasia' => 'Vulturnus Tech',
            'razao_social' => 'THOMAZ JULIANN BONCOMPAGNI',
            'cnpj' => '19131243000197',
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

        $response->assertStatus(404);
    }

    public function test_consultar_cnpj()
    {

        $response = $this->get('/api/fornecedores/buscar/19131243000197');
        $response->assertStatus(200)
            ->assertJsonFragment(['nome_fantasia' => 'REDE PELO CONHECIMENTO LIVRE']);
    }
}
