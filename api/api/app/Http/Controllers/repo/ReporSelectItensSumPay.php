<?php
namespace App\Http\Controllers\repo;

use App\Models\ModelSumItens;

final class ReporSelectItensSumPay 
{
    static public function SumItens($produtos)  {
        return  ModelSumItens::itensSum($produtos);
    }
}
