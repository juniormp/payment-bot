<?php


namespace App\Infrastructure\Repository;


use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements RepositoryInterface
{
    protected $model;
    protected $class;

    public function __construct()
    {
       $this->model = new $this->class;
    }

    public function getById(int $id){
        return $this->model->find($id);
    }

    public function getAll(){
        return $this->model->get();
    }

    public function save(Model $object){
        return $object->save();
    }

    public function delete(Model $object){
        return $object->delete();
    }
}
