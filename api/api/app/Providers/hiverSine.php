<?php





namespace App\Providers;

final class hiverSine 
{
    static private function haversineDistance($lat2, $lon2) {
        $raioTerra = 6371; 

        $lat1 = deg2rad(-12.58272);
        $lon1 = deg2rad(-55.75365);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $dLat = $lat2 - $lat1;
        $dLon = $lon2 - $lon1;

        $a = pow(sin($dLat / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($dLon / 2), 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $raioTerra * $c;
    }

    static public function getSumKms($lat, $lon) {
        $result = self::haversineDistance($lat, $lon);

        return floor(round($result, 2)*3);
    }
}
 