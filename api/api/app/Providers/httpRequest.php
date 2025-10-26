<?php

namespace App\Providers;

use Illuminate\Support\Facades\Http;

final class HttpRequest
{
  
    public static function getRequest(string $url)
    {
       
        $response = Http::get($url);

       
        if ($response->successful()) {
            return $response->json();
        }
 
         throw new \Exception("erro na requsicao http", 1);
        ;
    }
}
