<?php

namespace App\Providers;
\Stripe\Stripe::setApiKey('sk_test_51Q99ARRs5GhZx5A4AEgEDmULaaAesw4zKA0LSftIMjQptO93OvsXWX1zqB7GPE8nuG9AkRcwWiLbunHjC6l369Qd00qrLpseLH');

final class StripeService
{
    static private function redirectUrl()
    {
        return [
            'success_url' => 'http://localhost:8000/',
            'cancel_url'  => 'http://localhost:8000/404'
        ];
    }

    static private function pricesConfig(int $price, string $productName)
    {
        $cemNumber = 100;
        return [
            'currency' => 'brl',
            'product_data' => [
                'name' => $productName,
            ],
            'unit_amount' => $price * $cemNumber
        ];
    }

    static public function createPay(int $price, $idUser)
    {
        try {
            $checkoutSession = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            ...self::pricesConfig($price, 'produtos mercado sorriso')
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                ...self::redirectUrl(),

                'metadata' => [            
                    'user_id' => $idUser    
                ],
            ]);

            return $checkoutSession->url;
        } catch (\Throwable $th) {
            return ['erroStripe' => $th->getMessage()];
        }
    }
}