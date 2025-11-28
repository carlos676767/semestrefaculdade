<?php


namespace App\Providers;

use App\Http\Controllers\repo\ReporGetProducts;

final class ServiceGetProducts 
{
    static public function getItens()  {
        return ReporGetProducts::getProducts();


    }
}
