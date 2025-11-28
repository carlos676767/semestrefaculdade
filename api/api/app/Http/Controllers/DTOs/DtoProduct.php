<?php
namespace App\Http\Controllers\DTOs;

final class DtoProduct
{
    public function __construct(
       public string $nome,
    
       public int $price,
       public string $description
    
    ) {}
}
