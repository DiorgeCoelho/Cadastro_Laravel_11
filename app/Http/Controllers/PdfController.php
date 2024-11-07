<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf(){

        $options = new Options();

        $options->set('defaultFont', 'Courier');

        $produtos  = Produto::all()->sortByDesc('desc');

        $dompdf = new Dompdf($options);

        $dompdf->loadHtml(view('relatorios.Lista_Produtos', $produtos));

        $dompdf->setPaper('A4', 'portrait');

        $dompdf->render();

         // Enviar o PDF como resposta
        return $dompdf->stream('Pdf.pdf', ['Attachment' => false]);

    }
}
