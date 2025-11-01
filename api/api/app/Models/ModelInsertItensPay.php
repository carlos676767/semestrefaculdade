<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

final class ModelInsertItensPay
{
    public static function main($idUser, $itens)
    {
     

        try {
            DB::beginTransaction();

            foreach ($itens as $itemId) {
                DB::insert(
                    "INSERT INTO pedidos (user_id, item_id, status)
                     VALUES (?, ?, 'recebido')",
                    [$idUser, $itemId]
                );
            }

            DB::commit();
           
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new \Exception("Ocorreu um erro inesperado, tente novamente.", 1);
            
        }
    }
}
