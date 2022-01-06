<?php

namespace App\Services;

interface ComiteOrganisationNonLocalService{
    public function findAll();
    public function findByManifistation($manifestation);

}
