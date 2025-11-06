<?php


namespace App\Providers;


final class hiverSine 
{
    static private function hiverSineCords( $lat2, $lon2)  {
    $raioTerra = 6371;


    function deg($deg)  {
        return $deg * (pi() / 180);
    }


    $lat1 = deg(-12.58272);
    $lon1 = deg(-55.75365);
    $lat2 = deg($lat2);
    $lon2 = deg($lon2);

    $dLat = $lat2 - $lat1;
    $dLon = $lon2 - $lon1;

    $a = sin($dLat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($dLon / 2) ** 2;
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $raioTerra * $c;
    }


    static public function getSumKms($lat, $lon)  {
       
        $result = hiverSine::hiverSineCords($lat, $lon);
        return floor($result /100);

    }
}
