<?php

namespace App\Services;

interface EtablissementService
{
    public function findAll();

    public function findById($id);
}
