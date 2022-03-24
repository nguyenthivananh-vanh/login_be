<?php
namespace App\Repositories;

interface LoginInterface{
    public function all();
    public function get($id);
    public function store($data);
}