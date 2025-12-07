<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DTOs\DtodeleteItem;
use App\Http\Controllers\DTOs\DtoProduct;
use App\Http\Controllers\DTOs\DtoUpdateStatusItens;
use App\Http\Controllers\DTOs\DtoUpdateUserRole;
use App\Http\Requests\InsertAddressRequest;
use App\Http\Requests\InsertProductRequest;
use App\Http\Requests\UpdateStatusRequest;
use App\Models\ModelGetItensId;
use App\Models\ModelUpdatePedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Produto;
use App\Providers\ServiceAllItens;
use App\Providers\ServiceDeleteItem;
use App\Providers\ServiceGetCountItens;
use App\Providers\ServiceGetProducts;
use App\Providers\ServiceGetSelectUser;
use App\Providers\ServiceItensInsert;
use App\Providers\ServiceUpdateItemRole;
use App\Providers\ServiceUpdateStatusItens;


final class ControllerProducts extends Controller
{
    public function insertProducts(Request $req)
    {
        try {


            $data = json_decode($req->input('data'), true);



            $validator = Validator::make(
                array_merge($data, ['image' => $req->file('image')]),
                [
                    'name' => 'required|string|max:255',
                    'price' => 'required|numeric|min:0',
                    'description' => 'nullable|string|max:1000',
                    'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
                ],
                [
                    'name.required' => 'O nome do produto é obrigatório.',
                    'price.required' => 'O preço é obrigatório.',
                    'image.required' => 'A imagem do produto é obrigatória.',
                    'image.image' => 'O arquivo enviado deve ser uma imagem.',
                ]
            );

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'erro',
                    'erros' => $validator->errors()
                ], 400);
            }



            $dto = new DtoProduct(
                $data['name'],
                $data['price'],
                $data['description'],

            );




            ServiceItensInsert::Products($dto->nome, $dto->price, $dto->description, $req);

            return response()->json([
                'status' => 'sucesso',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'erro',
                'mensagem' => $th->getMessage()
            ], 500);
        }
    }


    static public function getProducts()
    {
        return   ServiceGetProducts::getItens();
    }




    static public function updateItemPay($id)
    {
        try {

            $dto = new DtoUpdateUserRole($id);

            ServiceUpdateItemRole::updateItemUser($dto->id);


            return response()->json([
                'success' =>   'sucesso',
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'error' => 'Erro ao atualizar tente novamente.',
            ], 400);
        }
    }


    static public function getProductsCount()
    {
        return response()->json([
            'success' =>  ServiceGetCountItens::countItens(),
        ], 200);
    }



    static public function getItensUser($id)
    {
        $dto = new DtoUpdateUserRole($id);
        return response()->json([
            'success' =>   ServiceGetSelectUser::selectUser($dto->id),
        ], 200);
    }



    static public function deleteItem($id)
    {
        $dto = new DtodeleteItem($id);


        try {
            ServiceDeleteItem::serviceDeleteItem($dto->idtem);

            return response()->json([
                'success' =>  true,
            ], 200);
        } catch (\Throwable $th) {



            return response()->json([
                'success' =>  $th->getMessage(),
            ], 400);
        }
    }


    static public function getAllItens()
    {
        return response()->json([
            'success' =>  ServiceAllItens::allItens(),
        ], 200);
    }





    static public function updateStatusPays( UpdateStatusRequest $request)
{
    try {
       

        $request->validated();

        
        $itemId  = $request->input('itemId');
        $userId  = $request->input('userId');
        $vSelect = $request->input('vSelect');
        $status = $request->input('status');
   
        $dto = new DtoUpdateStatusItens(
            $itemId,
            $userId,
            $vSelect,
            $status
        );

      
        $serviceSts = ServiceUpdateStatusItens::serviceUpdateItensSts(
          
            $dto->userId,
            $dto->idItem,
            $dto->vSelect,
            $dto->status
        );



        return response()->json([
            'success' =>  'alteracoes feita com sucesso.' 
        ], 200);
    } catch (\Throwable $th) {
  
        return response()->json([
            'success' =>  $th->getMessage()
        ], 400);
    }
}

}
