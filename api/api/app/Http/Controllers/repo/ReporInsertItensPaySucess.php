<?php
namespace App\Http\Controllers\repo;
use App\Models\ModelInsertItensPay;

final class ReporInsertItensPaySucess
{
    static public function InsertItensPay($userId, $produtos)  {
        ModelInsertItensPay::main($userId, $produtos);
    }
}
