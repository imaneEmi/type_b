<?php

namespace App\Services\util;

use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class Common
{
    public static function getAnneeActuelle()
    {
        return Carbon::now()->format('Y');
    }

    public static function readFileFromLocalStorage($url)
    {    

        if(Storage::disk('local')->exists($url)){
            $contents = Storage::disk('local')->get($url);
            $response = Response::make($contents, 200);
            $mimeType = Storage::mimeType($url);
            $response->header('Content-Type', $mimeType);
            return  $response;
        }
       
        return  null;
    }
}
