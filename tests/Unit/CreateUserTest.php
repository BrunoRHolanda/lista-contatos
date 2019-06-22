<?php

namespace Tests\Unit;

use App\User;
use function foo\func;
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
        factory(User::class, 2)->create()->each(function($user) {
            $this->assertDatabaseHas('users', [
                'email' => $user->email
            ]);
        });
    }
}
