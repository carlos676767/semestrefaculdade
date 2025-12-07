<?php

namespace App\Http\Controllers\repo;

use App\Models\modelInsertCepUser;

final class ReporInsertAddreas 
{
    static public function insert($user, $cep, $district, $lng, $lat, $state)  {
        try {
            modelInsertCepUser::insertCepUser($user, $cep, $district, $lng, $lat, $state);

        } catch (\Throwable $th) {
          throw new \Exception($th->getMessage(), 1);
          
        }
    }
}
