<?php

namespace App\Services;

interface ManifestationContributionParticipantService{
    public function findAll();
    public function findByManifistation($manifestation);

}
