<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testRegister()
    {
        // Dados de entrada para o registro
        $input = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        // Faça uma requisição POST para a rota de registro
        $response = $this->post('/register', $input);

        // Assert que a resposta tem status 302 (redirecionamento)
        $response->assertStatus(302);

        // Assert que o usuário foi criado no banco de dados
        $this->assertDatabaseHas('users', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    public function testLogin()
    {
        // Crie um usuário
        $user = User::factory()->create([
            'password' => bcrypt($password = 'password'),
        ]);

        // Faça uma requisição POST para a rota de login
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password,
        ]);

        // Assert que a resposta tem status 302 (redirecionamento)
        $response->assertStatus(302);

        // Assert que o usuário está autenticado
        $this->assertAuthenticatedAs($user);
    }
}
