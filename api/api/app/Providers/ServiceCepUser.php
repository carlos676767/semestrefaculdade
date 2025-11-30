<?php


namespace App\Providers;

use App\Http\Controllers\repo\ReporConnectDbCepGet;

final class ServiceCepUser 
{
    static public function serviceCepUserExistCep($id)  {
        return ReporConnectDbCepGet::connect($id);
        
    }
}
