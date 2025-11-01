<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ModelCep extends Model
{
    public static function getUserCep($id)
    {
        $endereco = DB::select("SELECT * FROM enderecos WHERE user_id = ? limit 1", [$id]);

       
       return $endereco;
       
    }
}
