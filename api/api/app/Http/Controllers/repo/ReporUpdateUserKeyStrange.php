<?php
namespace App\Http\Controllers\repo;

use App\Models\ModelGetItensId;

final class ReporUpdateUserKeyStrange 
{
    static public function getUser(int $id)  {
        return ModelGetItensId::getItemMy($id);
    }
}



