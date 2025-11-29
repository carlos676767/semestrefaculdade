<?php

namespace App\Providers;

use App\Http\Controllers\repo\ReporInsertItensPaySucess as RepoReporInsertItensPaySucess;
use App\Http\Controllers\repo\ReporSelectItensSumPay;
use App\Models\ModelInsertItensPay;
use App\Models\ModelSumItens;
use App\Providers\StripeService;
use App\Providers\MercadoPago;
use Illuminate\Support\Facades\Auth;
use ReporInsertItensPaySucess;

final class ServiceOptionPay
{
    static public function main($userId, $produtos, $pagamento)
    {


        try {


            $frete = ResultKmsSum::resultPriceKms($userId);
            $modelSumItensDb = ReporSelectItensSumPay::SumItens($produtos);

        
        
            $sumFinaly = $frete + (float)  $modelSumItensDb[0]->price;


            $options = [
                'pix' => function () use($sumFinaly) {
                    $email = Auth::user()->email;
                    return  MercadoPago::pix($sumFinaly, $email);
                },


                'card' => function () use ($sumFinaly, $userId) {
                    return StripeService::createPay($sumFinaly, $userId);
                },


            ];




            $result = $options[$pagamento];

            if ($result) {
                RepoReporInsertItensPaySucess::InsertItensPay($userId, $produtos);
                return  $result();

          
            }

            throw new \Exception("Erro ao criar pagamento, tente novamente.", 1);
        } catch (\Throwable $th) {
            throw new \Exception($th->getMessage(), 1);
        }
    }
}
