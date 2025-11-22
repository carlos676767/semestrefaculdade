<?php

namespace App\Http\Controllers;

use App\Models\ModelGetItensId;
use App\Models\ModelUpdatePedidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\Produto;

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


            $file = $req->file('image');
            $path = $file->store('uploads', 'public');

            $pathbs = asset('storage/' . $path);

            Produto::insertProduto($data['name'], $pathbs, $data['price'], $data['description']);
            return response()->json([
                'status' => 'sucesso',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'erro',
                'mensagem' => $th->getMessage()
            ], 500);
        }
    }


    static public function getProducts()
    {
        return   Produto::getProdutcts();
    }




    static public function updateItemPay($id)
    {
        try {

            ModelUpdatePedidos::update($id);
            return response()->json([
                'success' =>   'sucesso',
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'error' => 'Erro ao atualizar tente novamente.',
            ], 400);

        }
    }


    static public function getProductsCount()  {
        return response()->json([
            'success' =>   ModelGetItensId::getItensCount(),
        ], 200);
    }
}
