<?php

namespace App\Services\ServicesImpl;

use App\Models\User;
use App\Services\UserService;
use PhpParser\Node\Expr\Cast\Array_;

class UserServiceImpl implements UserService
{
    public function __construct()
    {

    }
    public function findAll(){
        return User::all();
    }
    public function findById($id){
        return User::findOrFail($id);
    }

    public  function save($user){

    }
    public  function update($user){

    }
    public  function delete($id){

    }
}
