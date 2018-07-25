<?php

    require '../../connection.php';
    require '../../vendor/autoload.php';
    use Dompdf\Dompdf;
    
    $dompdf = new Dompdf();
    $dompdf->set_option('defaultFont', 'Courier');

    $from = $_GET['from'];
    $to = $_GET['to'];

    $stmt = $conn->prepare("select checkInId,roomNo,ORNumber,collection,date_format(date_collected, '%M %d, %Y') as date_collected
     from billing A inner join checkout B on A.checkInId = B.id
      where date_format(date_collected, '%Y-%m-%d') >= ? and date_format(date_collected, '%Y-%m-%d') <= ? ");

    $stmt->bind_param('ss', $from,$to); 
    $stmt->execute();
    
    $result1 = $stmt->get_result() or die($conn->error);

    
    $header='<div class="header" style="margin-bottom:15px;">
                <h2>Collections</h2>
                <h5>Date From: '. $from .'</h5>
                <h5>Date To: '. $to .'</h5>
            </div>';

    $table =  '<table class="orderReceiptTable">
                
                <tr class="heading">
                    <td style="padding-bottom:5px; width:15%;" align="center">Room No.</td>
                    <td style="padding-bottom:5px; width:20%;" align="center">OR No.</td>
                    <td style="padding-bottom:5px; width:30%;" align="right">Date Collected</td>
                    <td style="padding-bottom:5px; width:35%;" align="right">Amount</td>
                </tr>';

    $total = 0;
        while($row = mysqli_fetch_assoc($result1)) {
        $roomNo = $row['roomNo'];
        $orNumber = $row['ORNumber'];
        $collection = $row['collection'];
        $date_collected = $row['date_collected'];
        $total = $total + $collection;

        $table .= '<tr>
                    <td align="center"> ' . $roomNo . ' </td><td align="center">' . $orNumber . '</td><td align="right">' . $date_collected . '</td><td align="right">' . $collection . '</td>
                </tr>';
    }

    $table .= '<tr>
                    <td colspan="3" align="right">Total:</td>
                    <td align="right"><span style="font-family: DejaVu Sans;">&#8369;</span>'. $total .'</td>
               </tr>
            </table>';
    
    $html="
    <html>
        <head>
        <link type='text/css' href='../../includes/css/dompdf.css' rel='stylesheet' />
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
        </head>
        <body>
            <header>" . $header . "</header>
            <main> " . $table . " </main>
            <footer></footer>
        </body>
    </html>";


    $dompdf->loadHtml($html);

    

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("Collections.pdf", array("Attachment" => false));

    exit(0);

?>
