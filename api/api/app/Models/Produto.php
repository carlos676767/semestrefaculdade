<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produto extends Model
{
    public static function insertProduto($nome, $img, $price, $descricao)
    {
        try {
            DB::beginTransaction();

            DB::insert(
                "INSERT INTO itens (nome, imagem, preco, descricao)
                 VALUES (?, ?, ?, ?)",
                [$nome, $img, $price, $descricao]
            );

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th; 
        }
    }


    public static function getProdutcts()  {
        return   DB::select("SELECT * FROM itens ORDER BY nome ASC ");
    }
}
