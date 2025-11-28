<?php
namespace App\Http\Controllers\repo;
use App\Models\Produto;

final class ReporProduct

   
{
    static public function insertProduct($nome,$ing, $price, $description )  {
      try {
          Produto::insertProduto($nome,$ing,  $price, $description);
      } catch (\Throwable $th) {
      throw new \Exception(   $th->getMessage(), 1);
      
      }
    }
}


