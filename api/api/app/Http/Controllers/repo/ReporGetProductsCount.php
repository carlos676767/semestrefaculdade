<?php

namespace App\Http\Controllers\repo;

use App\Models\ModelGetItensId;

final class ReporGetProductsCount 
{
    static public function getItensCount()  {
        return ModelGetItensId::getItensCount();
    }
}
