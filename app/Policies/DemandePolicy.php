<?php

namespace App\Policies;

use App\Models\Demande;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DemandePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function showDemande(User $user, Demande $demande)
    {
        return $user->id === $demande->coordonnateur_id
            ? Response::allow()
            : Response::deny('You do not own this demande.');
    }
}
