<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

final class ModelUpdatePedidos
{
    public static function update($userId, $sts, $str2)
    {
        try {
            DB::beginTransaction();

            DB::update(
                'UPDATE pedidos SET status = ? WHERE user_id = ? AND status = ?',
                [$str2, $userId, $sts]
            );



            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }





    public static function updateItemId($sts, $user, $sts2, $item)
    {
        try {
            DB::beginTransaction();

            DB::update(
                'UPDATE pedidos
SET status = ?
WHERE user_id = ?
  AND status = ?
  AND item_id = ?;
',
                [
                    $sts,
                    $user,
                    $sts2,

                    $item
                ]
            );



            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();

            throw new \Exception("erro ao update status, tente novamente.", 1);
            
        }
    }
}
