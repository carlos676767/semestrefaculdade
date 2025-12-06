<?php

namespace App\Http\Controllers\repo;

use App\Models\ModelItensDelete;

final class ReporDeleteItem
{
    static public function deleteItem($id)
    {
        try {
            ModelItensDelete::deleteItem($id);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);
        }
    }
}
