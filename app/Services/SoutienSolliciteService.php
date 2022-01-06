<?php

namespace App\Services;

interface SoutienSolliciteService{
    public function findAll();
    public function findByManifistation($manifestation);
    public  function  calculateTotal($soutienSollicite);

}
