<?php


namespace App\Http\Controllers;

use App\Http\Controllers\DTOs\Dtopdf;
use App\Models\ModelGetItensId;
use App\Providers\ServicePdfGenerate;
use Barryvdh\DomPDF\Facade\Pdf;


final class PdfController 
{
    static public function pdfGenerate($id)  {
        $dto = new Dtopdf(
            $id
        );



      return  ServicePdfGenerate::pdfGenerate($dto->id);
    }


    static public function pdfItens(){
        return  ServicePdfGenerate::pdfAllItens();
    }
}