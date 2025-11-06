<?php
namespace App\Models;

use Illuminate\Support\Facades\DB;

final class ModelUpdatePedidos 
{
    public static function update($userId)
    {
        try {
            DB::beginTransaction();

            DB::update(
                'UPDATE pedidos SET status = ? WHERE user_id = ? AND status = ?',
                ['em preparo', $userId, 'recebido']
            );

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack(); 
            throw $th;
        }
    }
}
