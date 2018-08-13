<?php

/* include autoloader */
require_once '../vendor/autoload.php';

/* reference the Dompdf namespace */
use Dompdf\Dompdf;

$dompdf = new DOMPDF();
$dompdf->load_html( file_get_contents( 'http://practicas:8888/pdf/countries.php' ) );
$dompdf->render();
$dompdf->stream("countries.pdf");