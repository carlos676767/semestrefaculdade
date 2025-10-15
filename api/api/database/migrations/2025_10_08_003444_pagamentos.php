<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        

        CREATE TABLE pagamentos (
            id_pagamento INT  AUTO_INCREMENT PRIMARY KEY,
            id_pedido INT NOT NULL,
            tipo_pagamento ENUM('mp','stripe') NOT NULL,
          FOREIGN KEY (id_pedido) REFERENCES pedidos(id) ON DELETE CASCADE

        ) 
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS pagamentos;");
    }
};
