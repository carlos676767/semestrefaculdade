<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

final class ModelItensDelete 
{
    public static function deleteItem(int $id)
    {
        try {
            DB::beginTransaction();
             DB::delete('DELETE FROM itens WHERE id = ?', [$id]);
            DB::commit();
        } catch (\Throwable $th) {
        


            DB::rollBack();

            throw new \Exception("Erro ao deletar item ,tente novamente.", 1);
            
        }
    }
}
