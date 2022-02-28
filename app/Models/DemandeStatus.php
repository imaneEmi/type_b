<?php

namespace App\Models;

abstract class DemandeStatus
{
    const COURANTE = "Nouvelle";
    const  ACCEPTEE = "Acceptée";
    const REFUSEE = "Refusée";
    const ENCOURS = "En cours de traitement";
}

