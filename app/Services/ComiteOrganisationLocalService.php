<?php

namespace App\Services;

interface ComiteOrganisationLocalService{
    public function findById($id);
    public function findChercheursByManifistation($manifestation);
}
