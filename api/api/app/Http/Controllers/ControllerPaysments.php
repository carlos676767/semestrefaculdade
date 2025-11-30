<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DTOs\DtoPagamento;
use App\Http\Requests\StorePagamentoRequest;
use App\Providers\ServiceOptionPay;
use Illuminate\Http\Request;


final class ControllerPaysments extends Controller
{
  static public function main(StorePagamentoRequest $req)
  {
    try {
 
  
   
      $req->validated();
      [
        'user_id' => $user_id,
        'produtos' => $produtos,
        'metodo_pagamento' => $metodo_pagamento
      ] = $req->all();

    


      $dto = new DtoPagamento($user_id, $produtos, $metodo_pagamento);
      $payResult = ServiceOptionPay::main($dto->userId, $dto->itens, $dto->metodo);
     return response()->json([
         'success' =>   $payResult,
      ], 200);
    } catch (\Throwable $th) {
    return  response()->json([
       
        'messagesss' => $th->getMessage(),
      ], 400);
    }

    
  }


 
}
