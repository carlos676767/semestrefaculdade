<?php

namespace App\Providers;

use App\Models\ModelItensDelete;

final class ServiceDeleteItem
{
    static public function serviceDeleteItem(int $id)
    {
        try {
            ModelItensDelete::deleteItem($id);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);
        }
    }
}
