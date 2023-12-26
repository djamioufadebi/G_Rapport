<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use Illuminate\Http\Request;

class PdfGenerateController extends Controller
{
    public function generatepdf()
    {
        $data = ['title' => 'Liste de projet'];
        $pdf = Pdf::loadView('vue_pdf', $data);
        return $pdf->download('vue.pdf');
    }

}
