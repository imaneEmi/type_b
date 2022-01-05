<?php

namespace App\Policies;

use App\Models\Demande;
use App\Models\User;
use App\Services\ChercheurService;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class DemandePolicy
{
    use HandlesAuthorization;

    private  $chercheurService;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(ChercheurService $chercheurService)
    {
        $this->chercheurService=$chercheurService;
    }

    public function showDemande(User $user, Demande $demande)
    {
        $chercheur = $this->chercheurService->findByEmail($user->email);
        return $chercheur->id_cher === $demande->coordonnateur_id
            ? Response::allow()
            : Response::deny('You do not own this demande.');
    }
}
