<?php

namespace App\Http\Controllers\repo;

use App\Models\modelInsertCepUser;

final class ReporInsertAddreas 
{
    static public function insert($user, $cep, $lat, $lng, $state, $district)  {
        try {
            modelInsertCepUser::insertCepUser($user, $cep, $district, $lat, $lng, $state);

        } catch (\Throwable $th) {
          throw new \Exception($th->getMessage(), 1);
          
        }
    }
}
