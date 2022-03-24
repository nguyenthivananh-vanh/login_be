<?php
namespace App\Repositories;
use App\Models\User;
class LoginRepository implements LoginInterface{
    public function all(){
        return User::get();
    }
    public function get($id){
        return User::find($id);
    }
    public function store($data){
        return User::create($data);
    }
}