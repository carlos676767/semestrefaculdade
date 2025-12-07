<?php


namespace App\Http\Controllers;

use App\Http\Controllers\DTOs\DtoFrete;
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
    
        $dto = new DtoFrete(
          $userId
        );



        return response()->json([
            'success' => ResultKmsSum::resultPriceKms($dto->userId),
            'a' => $userId,
        ], 200);


        
      } catch (\Throwable $th) {
        return response()->json([
            'success' => true,
            'frete' => $th->getMessage()
        ], 400);
      }
    }
}

