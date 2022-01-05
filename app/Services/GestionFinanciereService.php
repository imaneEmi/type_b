<?php

namespace App\Services;

interface GestionFinanciereService{
    public function findAll();
    public function findByManifistation($manifestation);

}
