<?php
namespace App\Providers;

use App\Http\Controllers\repo\Reporpdf;
use App\Http\Controllers\repor\RepositoryPdf;
use Barryvdh\DomPDF\Facade\Pdf;


final class ServicePdfGenerate
{
    static public function pdfGenerate($dtoValue) {
        
        $repor = Reporpdf::getResult($dtoValue);
        $pdf = Pdf::loadView('pdf.pdf', ['dados' => $repor ]);

        return $pdf->stream('historico.pdf');
    }


    static public function pdfAllItens()  {
        $itens = ServiceAllItens::allItens();

        $pdf = Pdf::loadView('pdf.pdfItens', ['dados' => $itens ]);

        return $pdf->stream('historico.pdf');
    }
}
