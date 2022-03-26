<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function update($target,$data);
    public function create($data);
    public function getAll();
    public function delete($clause = array());
}
