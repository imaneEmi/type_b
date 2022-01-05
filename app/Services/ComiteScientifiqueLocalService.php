<?php

namespace App\Services;

interface ComiteScientifiqueLocalService{
    public function findAll();
    public function findByManifistation($manifestation);

}
