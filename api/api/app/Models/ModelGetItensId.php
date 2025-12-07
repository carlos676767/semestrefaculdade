<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


final class ModelGetItensId 
{
  static public function getItens($id)  {
    $endereco = DB::select("SELECT *
FROM pedidos
JOIN itens ON pedidos.item_id = itens.id
WHERE pedidos.item_id = ?
ORDER BY pedidos.user_id", [$id]);

       
    return $endereco;
  }


  static public function getItensCount()  {

    return DB::select("SELECT
    (SELECT COUNT(nome) FROM itens) AS itensCadastrados,
    
    (SELECT SUM(i.preco) 
     FROM pedidos p
     JOIN itens i ON i.id = p.item_id
     WHERE p.status = 'em preparo') AS totalVendidos,
     
    (SELECT COUNT(item_id)
     FROM pedidos
     WHERE status = 'recebido') AS pedidosFeitos;

    
");
  }


  static public function getItemMy($id)  {
    return DB::select("

    SELECT 
  *
FROM pedidos
JOIN itens ON itens.id = pedidos.item_id
WHERE pedidos.status <> 'recebido'
  AND pedidos.user_id = ?;
    
", [
  $id
]);
  }



  static public function getItensAll(){
    return DB::select("
   
   
SELECT 
    users.name AS username,
    enderecos.cep,
    enderecos.rua,
    enderecos.longitude,
    enderecos.latitude,
    enderecos.estado,
    pedidos.status,
    itens.descricao,
    itens.nome AS itensName,
    itens.imagem,
    itens.id,
    users.id AS userid
FROM
    enderecos
        JOIN
    users ON users.id = enderecos.user_id
        JOIN
    pedidos ON users.id = pedidos.user_id
        JOIN
    itens ON itens.id = pedidos.item_id
   ", );
  }


  static public function getItem(){
    return DB::select("
   
  
    SELECT * FROM itens limit 1
       ", );
  }
}

