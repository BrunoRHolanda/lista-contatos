<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use App\Contact;
use Tests\TestCase;

class ContactResourceTest extends TestCase
{
    /**
     * Testa o acesso a rota protegida do index
     *
     * @return void
     */
    public function testNotAuthenticated()
    {
        $response = $this->get('/api/v1/contacts');

        $response->assertStatus(302);

        $response = $this->get('/api/v1/contacts/1');

        $response->assertStatus(302);

        $response = $this->get('/api/v1/contacts/search/asdad');

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

        // cria um contato
        $contact = factory(Contact::class)->make();

        // salva um contato para o usuário
        $user->contacts()->save($contact);

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
        ])->get('/api/v1/contacts');

        //verifica se o método foi acessado
        $response->assertStatus(200);
    }

    /**
     * Tenta salvar um contato
     *
     * @return void
     */
    public function testStoreAuthenticated()
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

        // cria um contato
        $contact = factory(Contact::class)->make();

        // tenta salvar o um contato
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->post('/api/v1/contacts', [
            'name' => $contact->name,
            'email' => $contact->email,
            'telephone' => $contact->telephone,
        ]);

        $response->assertStatus(201);
    }

    /**
     * Tenta salvar um contato
     *
     * @return void
     */
    public function testEditAuthenticated()
    {
        // cria um usuário
        $user = factory(User::class)->create([
            'password' => bcrypt('123456'),
        ]);

        // cria um contato
        $contact = factory(Contact::class)->make();

        // salva um contato para o usuário
        $user->contacts()->save($contact);

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

        // tenta salvar o um contato
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->put('/api/v1/contacts/' . $contact->id, [
            'id' => $contact->id,
            'name' => 'Testando contatos',
            'email' => $contact->email,
            'telephone' => 123456789,
        ]);

        $response->assertStatus(200);
    }

    /**
     * Tenta salvar um contato
     *
     * @return void
     */
    public function testDestroyAuthenticated()
    {
        // cria um usuário
        $user = factory(User::class)->create([
            'password' => bcrypt('123456'),
        ]);

        // cria um contato
        $contact = factory(Contact::class)->make();

        // salva um contato para o usuário
        $user->contacts()->save($contact);

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

        // tenta salvar o um contato
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->delete('/api/v1/contacts/' . $contact->id);

        $response->assertStatus(200);
    }

    /**
     * Tenta salvar um contato
     *
     * @return void
     */
    public function testSearchAuthenticated()
    {
        // cria um usuário
        $user = factory(User::class)->create([
            'password' => bcrypt('123456'),
        ]);

        // cria 100 contatos
        $contacts = factory(Contact::class, 100)->make()->each(function ($contact) use ($user) {
            // salva um contato para o usuário
            $user->contacts()->save($contact);
        });

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

        // tenta salvar o um contato
        $response = $this->withHeaders([
            'Authorization' => "Bearer $token",
        ])->get('/api/v1/contacts/search/a');

        $response->assertStatus(200);
    }
}
