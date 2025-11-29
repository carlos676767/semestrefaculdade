<?php
namespace App\Http\Controllers\DTOs;

final class DtoPagamento 
{
    public function __construct(
        public int $userId, 
        public array | int $itens,
        public string $metodo
    ) {

    }
}
