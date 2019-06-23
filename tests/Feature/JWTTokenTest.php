<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class JWTTokenTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLogin()
    {
        // cria um usuário
        $user = factory(User::class)->create([
            'password' => bcrypt('123456'),
        ]);

        // tenta fazer o login
        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => '123456'
        ]);

        // verifica se foi gerado o token
        $response->assertJson([
            "status" => "success",
        ]);
    }
}
