<?php

namespace App\Providers;

use App\Http\Controllers\repo\ReporSelectItem;
use App\Http\Controllers\repo\ReporUpdateStatusPay;

final class ServiceUpdateStatusItens 
{
    static public function serviceUpdateItensSts($user, $tem, $select, $selectayer)  {
        
    try {
        ReporUpdateStatusPay::connect($select, $user, $selectayer, $tem);
        $ressult = ReporSelectItem::connect();
        
        // $name = $ressult["nome"];

        $list = [

            "userId"=> $user,
            "itemAtt"=> $ressult,
            "newStatus"=> $selectayer

        ];

        HttpRequest::postRequest("http://localhost:3000/updateStatusWp", 

        $list
        );
    } catch (\Throwable $th) {
       throw new \Exception($th->getMessage(), 1);
       
    }


        
    }
}
