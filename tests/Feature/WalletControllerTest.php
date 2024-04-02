<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testCreate()
    {
        // Autentique como um usuário
        $user = User::factory()->create();
        $this->actingAs($user);

        // Faça uma requisição GET para a rota de criação de carteira
        $response = $this->get('/wallet/create');

        // Assert que a resposta tem status 200 (OK)
        $response->assertStatus(200);
    }

    public function testStore()
    {
        // Autentique como um usuário
        $user = User::factory()->create();
        $this->actingAs($user);

        // Faça uma requisição POST para a rota de armazenamento de carteira
        $response = $this->post('/wallet');

        // Assert que a resposta tem status 302 (redirecionamento)
        $response->assertStatus(302);

        // Assert que a carteira foi criada no banco de dados
        $this->assertDatabaseHas('wallets', [
            'user_id' => $user->id,
        ]);
    }
}
