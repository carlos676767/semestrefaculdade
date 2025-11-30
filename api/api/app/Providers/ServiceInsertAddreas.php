<?php

use App\Http\Controllers\repo\ReporInsertAddreas;

final class ServiceInsertAddreas
{
    static public function serviceInsert($userId, $cep, $district, $lat, $lng, $state) {
        ReporInsertAddreas::insert($userId, $cep, $lat, $lng, $state, $district);
    }
}
