<?php

use App\User;
use App\Contact;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Cadastra 5 usuários e um contato para cada usuário cadastrado.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function (User $user) {
            $user->contacts()->save(factory(Contact::class)->make());
        });
    }
}
