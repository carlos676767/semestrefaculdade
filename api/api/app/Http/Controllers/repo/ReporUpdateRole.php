<?php
namespace App\Http\Controllers\repo;

use App\Models\ModelUpdatePedidos;

final class ReporUpdateRole
{
    static public function updateUser($id){
        ModelUpdatePedidos::update($id);
    }
}
