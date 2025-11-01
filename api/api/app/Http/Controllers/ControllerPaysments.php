<?php

namespace App\Http\Controllers;

use App\Models\ModelCep;
use App\Models\modelInsertCepUser;
use App\Models\ModelInsertItensPay;
use App\Models\ModelSumItens;
use App\Providers\hiverSine;
use App\Providers\ResultKmsSum;
use App\Providers\ServiceOptionPay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use StripeService;

final class ControllerPaysments extends Controller
{
  static public function main(Request $req)
  {
    try {
      $validator = Validator::make($req->all(), [
        'produtos' => 'required|array|min:1',
        'produtos.*' => 'integer',
      ], [
        'produtos.required' => 'Você precisa selecionar pelo menos um produto para continuar.',
       
        'produtos.min' => 'Selecione pelo menos um produto antes de finalizar o pagamento.',
        'produtos.*.integer' => 'Um ou mais produtos informados são inválidos.',
      ]);
  
  
  
      if ($validator->fails()) {
        return response()->json([
       
          'message' => 'Ops! Encontramos alguns erros antes de continuar:',
          'errors' => $validator->errors()->all(), 
          'hint' => 'Verifique os produtos selecionados e tente novamente.'
        ], 422);
  
  
      }
  
   
      [
        'user_id' => $user_id,
        'produtos' => $produtos,
        'metodo_pagamento' => $metodo_pagamento
      ] = $req->all();
  
      $frete = ResultKmsSum::resultPriceKms($user_id);
      $modelSumItensDb = ModelSumItens::itensSum($produtos);
  
  
      $sumFinaly = $frete + (float)  $modelSumItensDb[0]->price;


      $payResult = ServiceOptionPay::main($metodo_pagamento,$sumFinaly);


      ModelInsertItensPay::main($user_id, $produtos);
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
