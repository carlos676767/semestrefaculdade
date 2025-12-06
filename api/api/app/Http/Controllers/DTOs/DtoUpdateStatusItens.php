<?php


namespace App\Http\Controllers\DTOs;



final class DtoUpdateStatusItens 
{
 public function __construct(

    public int $idItem,
    public int $userId,

    public string $vSelect,
    public string $status
 ) {

 }
}
