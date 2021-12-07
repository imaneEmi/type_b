<?php

namespace App\Services\util;

use Carbon\Carbon;

class Common
{
    public static function getAnneeActuelle()
    {
        return Carbon::now()->format('Y');
    }
}
