<?php
namespace App\Providers;

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

final class MercadoPago 
{
    static private function apiKey() {
        MercadoPagoConfig::setAccessToken(env( "MERCADOPAGO_KEY"));
    }

    static private function clientUser() {
        return new PaymentClient(); 
    }

    static public function pix($price, $clienteEmail) {

        try {
            MercadoPago::apiKey();

            $client = MercadoPago::clientUser();

            $payment = [
                "transaction_amount" => $price,
                "description" => "Pagamento PIX",
                "payment_method_id" => "pix",
                "payer" => [
                    "email" =>$clienteEmail
                ],

            
            ];

            return $client->create($payment)->point_of_interaction->transaction_data->ticket_url;

            

        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage());
        }
    } 
}
