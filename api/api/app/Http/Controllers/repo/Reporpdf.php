<?php
namespace App\Http\Controllers\repo;
use App\Models\ModelGetItensId;



final class Reporpdf
{



    static public function getResult($id)
    {
        return ModelGetItensId::getItemMy($id);
    }
}
