<?php

namespace App\Services;

interface ChercheurService
{
    public  function findAll();
    public  function findById($id);
    public  function findByEmail($email);

}
