<?php
namespace App\Http\Controllers\repo;

use App\Models\ModelUpdatePedidos;

final class ReporUpdateRole
{
    static public function updateUser($id, $sts, $st2){
        ModelUpdatePedidos::update($id,$sts, $st2);
    }
}


// 'recebido'