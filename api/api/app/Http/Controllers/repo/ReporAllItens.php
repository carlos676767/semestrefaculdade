<?php
namespace App\Http\Controllers\repo;

use App\Models\ModelGetItensId;

final class ReporAllItens 
{
   static public function allItens()  {
    return ModelGetItensId::getItensAll();
   } 
}
