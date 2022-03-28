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

    public function getAll()
    {
        return $this->model->get();
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
}
