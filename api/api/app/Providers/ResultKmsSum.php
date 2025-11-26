<?php




namespace App\Providers;

use App\Http\Controllers\repo\ReporFreteCalcule;
use App\Models\ModelCep;

final class ResultKmsSum
{
    static public function resultPriceKms($userId){
        $result = ReporFreteCalcule::databaseFrete($userId);
      
   
        $lng = $result[0]->longitude ?? null;
        $lat = $result[0]->latitude ?? null;


     return hiverSine::getSumKms($lat, $lng);


    }
}
