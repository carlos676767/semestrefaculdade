<?php

namespace App\Http\Controllers;

use App\Models\ModelCep;
use App\Models\modelInsertCepUser;
use App\Providers\HttpRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{
    static public function getCep(Request $req)  {
    try {
        $validator = Validator::make($req->all(), [
            'cep' => ['required', 'regex:/^\d{8}$/'] 
        ], [
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.regex' => 'O formato do CEP é inválido. Use o formato 00000-000.'
        ]);


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }


      $cep = $req->input('cep');
        
     $response =   HttpRequest::getRequest("https://cep.awesomeapi.com.br/json/$cep");
        return response()->json([
            'success' => true,
            'cep' => $response
        ]);
    } catch (\Throwable $th) {
         
        return response()->json([
            'errors' => $th->getMessage(),
        ]);
    }
    }





    static public function getUserExistAddreas($id) {
        return response()->json([
            'success' => ModelCep::getUserCep($id),
        ]);
    }



    static public function insertAddreas(Request $req)
    {
      
        
        try {
            $validator = Validator::make($req->all(), [
                'userId' => ['required', 'integer', 'exists:users,id'],
                'cep'    => ['required', 'regex:/^\d{8}$/'],
                'lat'    => ['required', 'numeric', 'between:-90,90'],
                'lng'   => ['required', 'numeric', 'between:-180,180'],
                'state' => ['required', 'string', 'max:50'],
                'district' => ['required', 'string', 'max:50'],
            ], [
              
    
                'userId.required' => 'O campo userId é obrigatório.',
                'userId.integer'  => 'O campo userId deve ser um número inteiro.',
                'userId.exists'   => 'O usuário informado não existe.',
        
                'cep.required' => 'O campo CEP é obrigatório.',
                'cep.regex'    => 'O formato do CEP é inválido. Use apenas números (ex: 12345678).',
        
                'lat.required'  => 'A latitude é obrigatória.',
                'lat.numeric'   => 'A latitude deve ser um número.',
                'lat.between'   => 'A latitude deve estar entre -90 e 90.',
        
                'lng.required' => 'A longitude é obrigatória.',
                'lng.numeric'  => 'A longitude deve ser um número.',
                'lng.between'  => 'A longitude deve estar entre -180 e 180.',
        
                'state.required' => 'O campo estado é obrigatório.',
                'state.string'   => 'O estado deve ser um texto.',
                'state.max'      => 'O nome do estado não pode ter mais de 50 caracteres.',
    
            ]);
        
            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors(),
                ], 422);
            }
        
         
            $userId  = $req->userId;
            $cep = (int) $req->cep;
            $lat  = (float) $req->lat;
            $lng = (float) $req->lng;
            $state  = $req->state;
            $district = $req->district;
    
            modelInsertCepUser::insertCepUser($userId, $cep, $district, $lat, $lng, $state);


            return response()->json([
                'success' => true,
                'message' => 'Endereço validado e inserido com sucesso!',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
        
    
      
    }
}
