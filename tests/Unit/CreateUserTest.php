<?php

namespace Tests\Unit;


use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\User;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testCreateUser()
    {
        factory(User::class, 2)->create()->each(function ($user) {
            $this->assertDatabaseHas('users', [
                'email' => $user->email
            ]);
        });
    }
}
