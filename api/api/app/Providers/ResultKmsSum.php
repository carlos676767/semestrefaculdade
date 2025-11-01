<?php




namespace App\Providers;
use App\Models\ModelCep;

final class ResultKmsSum
{
    static public function resultPriceKms($userId){
        $result =  ModelCep::getUserCep($userId);
      
   
        $lng = $result[0]->longitude ?? null;
        $lat = $result[0]->latitude ?? null;


     return hiverSine::getSumKms($lat, $lng);
    }
}
