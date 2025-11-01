<?php


namespace App\Http\Controllers;

use App\Models\ModelCep;
use App\Models\modelInsertCepUser;
use App\Providers\hiverSine;
use App\Providers\ResultKmsSum;
use Illuminate\Http\Request;



final class FreteController
{
    static public function getFrete($userId)
    {
      try {
    
        return response()->json([
            'success' => ResultKmsSum::resultPriceKms($userId),
        ], 200);
      } catch (\Throwable $th) {
        return response()->json([
            'success' => true,
            'frete' => $th->getMessage()
        ], 400);
      }
    }
}

