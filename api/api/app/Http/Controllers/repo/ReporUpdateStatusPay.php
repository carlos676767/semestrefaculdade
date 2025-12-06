<?php
namespace App\Http\Controllers\repo;

use App\Models\ModelUpdatePedidos;

final class ReporUpdateStatusPay
{
 static public function connect($sts, $user, $sts2, $item)  {
    try {
        ModelUpdatePedidos::updateItemId($sts, $user, $sts2, $item);
    } catch (\Throwable $th) {
      
        throw new \Exception($th->getMessage(), 1);
        
    }
 }   
}
