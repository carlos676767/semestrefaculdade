<?php

namespace App\Http\Controllers\DTOs;

final class DtoInsertAddreas
{
    public function __construct(
        public int $user,
        public int $cep,
        public float $lat,
        public float $lng,
        public string $state,
        public string $district
    ) {}
}
