<?php


namespace App\Repository;

use Illuminate\Database\Eloquent\Builder;

interface IRepository
{
    public function create($params);
    public function update(int $id, $params);
    public function find(int $id);
    public function findAll();
    public function fetchAll(Builder $builder);
    public function fetch(Builder $builder);
    public function remove(int $id);
}
