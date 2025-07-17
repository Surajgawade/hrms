<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// define('DOMPDF_ENABLE_AUTOLOAD', false);
 include(APPPATH ."third_party/dompdf/dompdf_config.inc.php");

class Pdfgenerator {

  public function generate($html, $filename='', $stream=TRUE, $paper = 'A4', $orientation = "portrait")
  {
    // print_r('here');
    // exit;
   
     $dompdf = new DOMPDF();
   // $options = new Options();
//$dompdf = new Dompdf($options);
    $dompdf->load_html($html);
   //$dompdf->set('isRemoteEnabled', true);

    $dompdf->set_paper($paper, $orientation);
    $dompdf->render();
    if ($stream) {
        $dompdf->stream($filename.".pdf");
    } else {
        return $dompdf->output();
    }
  }
}