<?php


namespace App\Repository;


use App\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository extends Repository
{
    function __construct()
    {
        parent::__construct(User::class);
    }

    /**
     * Sobreescreve o create padrão para adicionar o criptografia da senha antes
     * do usuário ser salvo.
     *
     * @param $params
     *
     * @return mixed
     */
    public function create($params)
    {
        $params['password'] = bcrypt($params['password']);

        return parent::create($params);
    }

    /**
     * Sobreescreve o update padrão para adicionar o criptografia da senha antes
     * do usuário ser salvo.
     *
     * @param int $id
     *
     * @param $params
     *
     * @return Model|object|null
     */
    public function update(int $id, $params)
    {
        if (isset($params['password']) && !empty($params['password'])) {
            $params['password'] = bcrypt($params['password']);
        }

        return parent::update($id, $params);
    }
}
