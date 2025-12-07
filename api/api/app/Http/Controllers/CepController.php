<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DTOs\DtoInsertAddreas;
use App\Http\Controllers\DTOs\DtoUser;
use App\Http\Requests\CepValidate;
use App\Http\Requests\InsertAddressRequest;
use App\Models\ModelCep;
use App\Models\modelInsertCepUser;
use App\Providers\HttpRequest;
use App\Providers\ServiceCepUser;
use App\Providers\ServiceInsertAddreas;
use Barryvdh\DomPDF\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CepController extends Controller
{
    static public function getCep(CepValidate $req)  {


        $req->validated();
      try {
    
        $cep = $req->input('cep');
          
  
          return response()->json([
              'success' => true,
              'cep' => HttpRequest::getRequest("https://cep.awesomeapi.com.br/json/$cep")
          ]);
      } catch (\Throwable $th) {
      
        
        return response()->json([
            'err'=> $th->getMessage()
        ]);
      }
    }





    static public function getUserExistAddreas($id) {

        $dto = new DtoUser(
            $id
        );


      
        return response()->json([
            'success' => ServiceCepUser::serviceCepUserExistCep($dto->user),
        ]);
    }



    static public function insertAddreas(InsertAddressRequest $req)
    {
      
        
        try {
          
            $req->validated();
         
         
          
          
           
            $dto = new DtoInsertAddreas(
                $req->userId, 
                (int) $req->cep,
                (float) $req->lat,
                (float) $req->lng,
                $req->state,
                $req->district
            );
    
         ServiceInsertAddreas::serviceInsert($dto->user, $dto->cep,$dto->district, $dto->lng,$dto->lat,$dto->state);


            return response()->json([
                'success' => true,
                'message' => 'Endereço validado e inserido com sucesso!',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
        
    
      
    }
}
