<?php


namespace App\Http\Controllers;

use App\Models\ModelGetItensId;
use Barryvdh\DomPDF\Facade\Pdf;

final class PdfController 
{
    static public function pdfGenerate($id)  {
       $v = ModelGetItensId::getItemMy($id);
        $pdf = Pdf::loadView('pdf.pdf', ['dados' => $v ]);

        return $pdf->stream('historico.pdf');
    }
}
