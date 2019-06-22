<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateUserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $user = factory(User::class, 2)->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
    }
}
