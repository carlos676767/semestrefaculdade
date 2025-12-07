<?php
namespace App\Providers;

use App\Http\Controllers\repo\ReporUpdateUserKeyStrange;

final class ServiceGetSelectUser 
{
    static public function selectUser( int $id)  {
        return ReporUpdateUserKeyStrange::getUser($id);
    }
}
