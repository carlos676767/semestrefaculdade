<?php


namespace App\Providers;

use App\Models\ModelGetItensId;

final class ServiceGetCountItens 
{
    static public function countItens()  {
        return ModelGetItensId::getItensCount();
    }
}
