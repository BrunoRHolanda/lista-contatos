<?php


namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

interface IRepository
{
    public function save(Model $eloquent);
    public function find(int $id);
    public function findAll();
    public function fetchAll(Builder $builder);
    public function fetch(Builder $builder);
    public function remove(Model $eloquent);
}
