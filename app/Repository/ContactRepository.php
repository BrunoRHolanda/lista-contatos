<?php


namespace App\Repository;


use App\Contact;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ContactRepository extends Repository
{
    function __construct()
    {
        parent::__construct(Contact::class);
    }

    /**
     * Retorna todos os contatos do usuário informado.
     *
     * @param int $userId
     *
     * @return Builder[]|Collection
     */
    public function findAllByUser(int $userId)
    {
        return $this->fetchAll(Contact::where('user_id', '=', $userId));
    }

    /**
     * Busca um determinado contato por usuário.
     *
     * @param int $userId
     *
     * @param int $contactId
     *
     * @return Builder[]|Collection
     */
    public function findByUser(int $userId, int $contactId)
    {
        return $this->fetchAll(Contact::where('user_id', '=', $userId)
            ->where('id', '=', $contactId)
        );
    }

    /**
     * Busca qualquer relação do texto com os contatos do usuário.
     *
     * @param int $userId
     *
     * @param string $text
     *
     * @return Builder[]|Collection
     *
     */
    public function findBySearchText(int $userId, string $text)
    {
        return $this->fetchAll(Contact::where('user_id', '=', $userId)
            ->where(function (Builder $builder) use ($text) {
                $builder->where('name', 'like', "%$text%")
                    ->orWhere('email', 'like', "%$text%")
                    ->orWhere('telephone', 'like', "%$text%");
            })
        );
    }

    /**
     * Remove o contato por usuário informado.
     *
     * @param int $userId
     *
     * @param int $id
     *
     * @return Model|object|null
     *
     * @throws Exception
     */
    public function removeByUser(int $userId, int $id)
    {
        $contact = $this->findByUser($userId, $id);

        if ($contact) {
            return parent::remove($id);
        }

        return null;
    }

    /**
     * cria um novo contato no banco de dados.
     *
     * @param $user
     * @param $params
     *
     * @return mixed
     */
    public function createByUser($user, $params)
    {
        $contact = parent::create($params);

        $contact->user()->associate($user);

        $contact->save();

        return $contact;
    }
}
