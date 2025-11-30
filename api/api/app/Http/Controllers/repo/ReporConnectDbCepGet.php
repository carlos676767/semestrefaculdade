<?php
namespace App\Http\Controllers\repo;

use App\Models\ModelCep;

final class ReporConnectDbCepGet 
{
    static public function connect($id)  {
        return ModelCep::getUserCep($id);
    }
}
