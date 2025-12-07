<?php
namespace App\Providers;
use App\Http\Controllers\repo\ReporInsertAddreas;

final class ServiceInsertAddreas
{
    static public function serviceInsert($user, $cep, $district, $lng, $lat, $state) {
     try {
        ReporInsertAddreas::insert($user, $cep, $district, $lng, $lat, $state);
     } catch (\Throwable $th) {
      throw new \Exception($th->getMessage(), 1);
     }
    }
}
