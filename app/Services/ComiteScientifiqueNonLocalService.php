<?php

namespace App\Services;

interface ComiteScientifiqueNonLocalService{
    public function findAll();
    public function findByManifistation($manifestation);

}
