<?php

namespace App\Http\Controllers\DTOs;

final class DtoInsertAddreas
{
    public function __construct(
        public int $user,
        public int $cep,
        public float $lat,
        public float $lont,
        public string $state,
        public string $descrict
    ) {}
}
