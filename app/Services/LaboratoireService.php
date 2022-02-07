<?php

namespace App\Services;

interface LaboratoireService
{
    public  function findAll();
    public  function findById($id);
    public  function findAllByEtablissement($id);
}
