<?php

namespace App\Http\Controllers\repo;

use App\Models\ModelCep;

final class ReporFreteCalcule 
{
   static public function databaseFrete($id) {
    return ModelCep::getUserCep($id);

    
   }
}
