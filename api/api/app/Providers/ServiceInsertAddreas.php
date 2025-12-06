<?php
namespace App\Providers;
use App\Http\Controllers\repo\ReporInsertAddreas;

final class ServiceInsertAddreas
{
    static public function serviceInsert($userId, $cep, $district, $lat, $lng, $state) {
     try {
        ReporInsertAddreas::insert($userId, $cep, $lat, $lng, $state, $district);
     } catch (\Throwable $th) {
      throw new \Exception($th->getMessage(), 1);
     }
    }
}
