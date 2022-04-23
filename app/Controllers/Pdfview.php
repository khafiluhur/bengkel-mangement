<?php
namespace App\PdfView;
use CodeIgniter\Controller;
use Dompdf\Dompdf;

class Pdfview extends Controller {

    public function index()
    {
        return view('pdf_view');
    }
    public function generate()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        $filename = date('y-m-d-H-i-s'). '-qadr-labs-report';

        // load HTML content
        $dompdf->loadHtml(view('pdf_view'));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename);
    }
}