<?php
    

    require 'vendor/autoload.php';
    use Dompdf\Dompdf;
    $filename=$_POST["mydata"];
    
    $dompdf = new Dompdf();
    $dompdf->set_option('defaultFont', 'Courier');

    $dompdf->loadHtml('<h3 style="text-align:center;"></h3>');

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("Orders_Receipt.pdf", array("Attachment" => false));

    exit(0);
?>