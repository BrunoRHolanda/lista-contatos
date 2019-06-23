<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use Tests\TestCase;

class UserResourceTest extends TestCase
{

    /**
     * Testa o acesso a rota protegida do index
     *
     * @return void
     */
    public function testIndexNotAuthenticated()
    {
        $response = $this->get('/api/v1/users');

        $response->assertStatus(302);
    }

    /**
     * Testa o acesso a rota index
     *
     * @return void
     */
    public function testIndexAuthenticated()
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

        // pega token de resposta
        $token = $response->headers->get('Authorization');

        // tenta acessar a rota
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->get('/api/v1/users');

        //verifica se o método foi acessado
        $response->assertStatus(501);
    }

    /**
     * Tenta salvar um usuário
     *
     * @return void
     */
    public function testStoreNotAuthenticated()
    {
        // cria um usuário
        $user = factory(User::class)->make([
            'password' => '123456',
        ]);

        // tenta salvar o mesmo
        $response = $this->post('/api/v1/users', [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
        ]);

        $response->assertStatus(201);
    }

    /**
     * Tenta editar um usuário
     *
     * @return void
     */
    public function testEditAuthenticated()
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

        // pega token de resposta
        $token = $response->headers->get('Authorization');

        // tenta modificar o usuário
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->put('/api/v1/users/' . $user->id, [
            'name' => 'Teste Bruno',
            'email' => $user->email,
            'password' => '',
        ]);

        //verifica se o método foi acessado
        $response->assertStatus(200);
    }

    /**
     * Tenta modificar um usuário inválido
     *
     * @return void
     */
    public function testEditInvalidAuthenticated()
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

        // pega token de resposta
        $token = $response->headers->get('Authorization');

        // tenta modificar o usuário
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->put('/api/v1/users/0', [
            'name' => 'Teste Bruno',
            'email' => $user->email,
            'password' => '',
        ]);

        //verifica se o método foi acessado
        $response->assertStatus(400);
    }

    /**
     * Tenta remover o cadastro do usuário logado.
     *
     * @return void
     */
    public function testDestroyAuthenticated()
    {
        // cria um usuário
        $user = factory(User::class)->create([
            'password' => bcrypt('123456'),
        ]);

        $response = $this->post('/api/auth/login', [
            'email' => $user->email,
            'password' => '123456'
        ]);

        // verifica se foi gerado o token
        $response->assertJson([
            "status" => "success",
        ]);

        // pega token de resposta
        $token = $response->headers->get('Authorization');

        // tenta modificar o usuário
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->delete('/api/v1/users/' . $user->id);

        //verifica se o método foi acessado
        $response->assertStatus(200);
    }
}
