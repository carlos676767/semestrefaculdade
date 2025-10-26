<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class modelInsertCepUser extends Model
{
    public static function insertCepUser($userId, $cep, $rua, $longitude, $latitude, $estado)
    {
        try {
            DB::beginTransaction();

            DB::insert(
                'INSERT INTO enderecos (user_id, cep, rua, longitude, latitude, estado) VALUES (?, ?, ?, ?, ?, ?)',
                [$userId, $cep, $rua, $longitude, $latitude, $estado]
            );
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th; 
        }
    }


}
