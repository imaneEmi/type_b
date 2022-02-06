<?php

namespace App\Models;

abstract class DemandeStatus
{
    const COURANTE = "Courante";
    const  ACCEPTEE = "Acceptée";
    const REFUSEE = "Refusée";
    const ENCOURS = "En cours de traitement";
}

