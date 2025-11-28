<?php
namespace App\Http\Controllers\repo;

use App\Models\Produto;

final class ReporGetProducts 
{
    static public function getProducts()  {
        return Produto::getProdutcts();
    }
}
