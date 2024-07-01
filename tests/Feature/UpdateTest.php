<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vendedor;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class UpdateTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(\Database\Seeders\UserSeeder::class);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_update()
    {
        $vendedor = Vendedor::factory()->create([
            'nome_vendedor' => 'Antigo Nome',
            'email' => 'antigo@vendas.com.br',
            'senha' => Hash::make('senha_antiga'),
        ]);

        $user = User::where('email', 'adm@adm.com.br')->first();
        
        $this->assertNotNull($user, "User with email 'adm@adm.com.br' not found");

        $token = JWTAuth::fromUser($user);

        $data = [
            'nome_vendedor' => 'João',
            'email' => 'joao@vendas.com.br',
            'senha' => '123'
        ];

        $response = $this->json('PUT', "/api/app/vendedores/{$vendedor->id}", $data, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'nome_vendedor' => 'João',
            'email' => 'joao@vendas.com.br',
        ]);

        $this->assertTrue(Hash::check('123', Vendedor::find($vendedor->id)->senha));
    }
}
