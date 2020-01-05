<?php


namespace App\Infrastructure\Repository;


use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
    public function getAll();

    public function getById(int $id);

    public function save(Model $object);

    public function delete(Model $object);
}
