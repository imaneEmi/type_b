<?php

namespace App\Services;

interface UserService
{
    public  function findAll();
    public  function findById($id);
    public  function save($user);
    public  function update($user);
    public  function delete($id);
}
