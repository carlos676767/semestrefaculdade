<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
final class ModelSumItens 
{
    static public function  itensSum(array $list){

     $query = join( ',',    array_map(function ($c)  {
        return '?';
     }, $list));


     return  DB::select("SELECT sum(preco) as price  from  itens  where id in($query)", $list);
    }
}
