<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Contact;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Cadastra 5 usuários e 50 contatos para cada usuário cadastrado.
     *
     * Cria um usuário padrão com 100 contatos na lista.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create()->each(function (User $user) {

            factory(Contact::class, 50)->make()->each(function (Contact $contact) use ($user) {
                $user->contacts()->save($contact);
            });
        });

        $default = User::create([
            'name' => 'Antônio Padrão',
            'email' => 'default@contato.com.br',
            'password' => bcrypt('123456')
        ]);

        factory(Contact::class, 100)->make()->each(function (Contact $contact) use ($default) {
            $default->contacts()->save($contact);
        });
    }
}
