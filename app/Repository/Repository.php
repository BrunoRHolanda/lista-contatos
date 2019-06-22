<?php


namespace App\Repository;


use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Repositório base para a fácil implementação de um novo repositório
 * Esse já realiza as funções mais comuns ficando apenas a critério do desenvolvedor
 * inserir as regras de negócio específicas.
 *
 * Class Repository
 *
 * @package App\Repository
 *
 */
class Repository implements IRepository
{
    /**
     * Namespace para classe modelo do repositório.
     *
     * @var Model $modelClass
     *
     */
    private $modelClass;

    /**
     * Repository constructor.
     *
     * @param $modelClass
     *
     */
    public function __construct($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    /**
     * Salva os dados de um determinado modelo
     *
     * @param Model $eloquent
     *
     * @return Model
     */
    public function save(Model $eloquent)
    {
        $eloquent->save();

        return $eloquent;
    }

    /**
     * Encontra um modelo por seu id.
     *
     * @param int $id
     *
     * @return Builder|Model|object|null
     *
     */
    public function find(int $id)
    {
        $model = new $this->modelClass();

        return $this->modelClass::query()->where(
            $model->getKeyName(), '=', $id)->first();
    }

    /**
     * Retorna todos os modelos sem paginação
     *
     * @return \Illuminate\Database\Eloquent\Collection|Model[]
     *
     */
    public function findAll()
    {
        return $this->modelClass::all();
    }

    /**
     * Retorna todos os resultados de acordo com o builder informado.
     *
     * @param Builder $builder
     *
     * @return Builder[]|\Illuminate\Database\Eloquent\Collection
     *
     */
    public function fetchAll(Builder $builder)
    {
        return $builder->get();
    }

    /**
     * retorna o primeiro resultado de acordo com o builder informado.
     *
     * @param Builder $builder
     *
     * @return Builder|Model|object|null
     *
     */
    public function fetch(Builder $builder)
    {
       return $builder->first();
    }

    /**
     * Remove o modelo informado.
     *
     * @param Model $eloquent
     *
     * @throws Exception
     *
     */
    public function remove(Model $eloquent)
    {
        $eloquent->delete();
    }

    /**
     * Pagina os resultados de acordo com o builder informado.
     *
     * @param Builder $builder
     *
     * @param int $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     *
     */
    public function paginate(Builder $builder, int $perPage)
    {
        return $builder->paginate($perPage);
    }
}