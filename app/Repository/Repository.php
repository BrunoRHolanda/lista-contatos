<?php


namespace App\Repository;


use Schema;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

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
     * cria um novo modelo no banco de dados.
     *
     * @param $params
     *
     * @return mixed
     */
    public function create($params)
    {
        /* @var Model $model */
        $model = new $this->modelClass($params);

        $model->save();

        return $model;
    }

    /**
     * Salva as alterações se o modelo for encontrado.
     *
     * @param int $id
     *
     * @param $params
     *
     * @return Model|object|null
     */
    public function update(int $id, $params)
    {
        $model = $this->find($id);

        if ($model) {
            $fields = Schema::getColumnListing($model->getTable());

            foreach ($fields as $field) {
                $model->{$field} = $params[$field] ?? $model->{$field};
            }

            $model->save();
        }

        return $model;
    }

    /**
     * Encontra um modelo por seu id.
     *
     * @param int $id
     *
     * @return Model|object|null
     *
     */
    public function find(int $id)
    {
        /* @var Model $model */
        $model = new $this->modelClass();

        return $this->modelClass::query()->where(
            $model->getKeyName(), '=', $id)->first();
    }

    /**
     * Retorna todos os modelos sem paginação
     *
     * @return Collection|Model[]
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
     * @return Builder[]|Collection
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
     * @param int $id
     *
     * @return Model|object|null
     *
     * @throws Exception
     */
    public function remove(int $id)
    {
        $model = $this->find($id);

        if ($model) {
            $model->delete();
        }

        return $model;
    }

    /**
     * Pagina os resultados de acordo com o builder informado.
     *
     * @param Builder $builder
     *
     * @param int $perPage
     *
     * @return LengthAwarePaginator
     *
     */
    public function paginate(Builder $builder, int $perPage)
    {
        return $builder->paginate($perPage);
    }
}