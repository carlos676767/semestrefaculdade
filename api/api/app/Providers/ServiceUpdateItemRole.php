<?php
namespace App\Providers;

use App\Http\Controllers\repo\ReporUpdateRole;

final class ServiceUpdateItemRole 
{
    static public function updateItemUser($ID)  {
        ReporUpdateRole::updateUser($ID);
    }
}
