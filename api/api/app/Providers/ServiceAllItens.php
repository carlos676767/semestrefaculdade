<?php
namespace App\Providers;

use App\Http\Controllers\repo\ReporAllItens;

final class ServiceAllItens 
{
    static public function allItens()  {
        return ReporAllItens::allItens();

    }
}




