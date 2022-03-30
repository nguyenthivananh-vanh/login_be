<?php

namespace App\Repositories;

interface RepositoryInterface
{
    public function update($target,$data);
    public function getAll($raw);
    public function delete($clause = array());
    public function create($data);
    public function find($data);
    public function get($clause, $raw);
}
