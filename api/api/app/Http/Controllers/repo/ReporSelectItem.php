<?php
namespace App\Http\Controllers\repo;

use App\Models\ModelGetItensId;

final class ReporSelectItem 
{
   static public function connect()  {
    return ModelGetItensId::getItem();
   } 
}
