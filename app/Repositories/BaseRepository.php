<?php

namespace App\Repositories;

class BaseRepository implements RepositoryInterface
{
    protected $model;

    /**
     * BaseRepository constructor.
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getAll($raw)
    {
        return $this->model->select($raw)->get();
    }

    public function update($target,$data)
    {
        return $target->update($data);
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function delete($clause = array())
    {
        $target = $this->model->where($clause)->first();
        return $target->delete();
    }
    public function find($data){
        return $this->model->find($data);
    }

    public function get($clause, $raw)
    {
       return $this->model->where($clause)->select($raw)->get();
    }

    public function paginate($start, $limit){
        return $this->model->offset($start)->limit($limit)->get();
    }

    public function getTotal(){
        return $this->model->count();
    }
}
