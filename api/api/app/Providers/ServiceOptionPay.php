<?php

namespace App\Providers;

use App\Providers\StripeService;
final class ServiceOptionPay
{
    static public function main( string $option, $price, $idUser)
    {


        $options = [
            'pix' => function () use($price) {

            },


            'card' => function () use($price, $idUser) {
               return StripeService::createPay($price, $idUser);
            },


        ];


        

        $result = $options[$option];

        if ($result) {
            return  $result();
        }

        throw new \Exception("Erro ao criar pagamento, tente novamente.", 1);
    }
}
