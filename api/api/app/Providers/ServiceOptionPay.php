<?php

namespace App\Providers;

use App\Providers\StripeService;
final class ServiceOptionPay
{
    static public function main( string $option, $price)
    {


        $options = [
            'pix' => function () use($price) {

            },


            'card' => function () use($price) {
               return StripeService::createPay($price);
            },


        ];


        

        $result = $options[$option];

        if ($result) {
            return  $result();
        }

        throw new \Exception("Erro ao criar pagamento, tente novamente.", 1);
    }
}
