<?php

    require '../../connection.php';
    require '../../vendor/autoload.php';
    use Dompdf\Dompdf;
    
    $dompdf = new Dompdf();
    $dompdf->set_option('defaultFont', 'Courier');

    $checkInId = $_GET['checkInId'];
    
    $stmt = $conn->prepare("SELECT A.id, sum(A.quantity) as quantity, B.menuName, (B.sellingPrice * quantity) as totalPrice from addedfoods A inner join foods B on A.foodsId = B.id where A.checkinId = ? GROUP by A.foodsId");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $result = $stmt->get_result() or die($conn->error);

    $stmt = $conn->prepare("SELECT ORNumber,now() as dateNow from billing where checkInId = ?");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $result1 = $stmt->get_result() or die($conn->error);

    while($row = mysqli_fetch_assoc($result1)) {
        $ORNumber = $row['ORNumber'];
        $now = $row['dateNow'];
    }
    
    $header='<div class="header">
                <h2>Orders Receipt</h2>
                <h5>OR Number: '. $ORNumber .'</h5>
                <h5>Date: '. $now .'</h5>
            </div>';

    $table =  '<table class="orderReceiptTable">
                
                <tr class="heading">
                    <td style="padding-bottom:5px;">Menu</td>
                    <td style="padding-bottom:5px;">Quantity</td>
                    <td style="padding-bottom:5px;" align="right">Price</td>
                </tr>';

    $total = 0;
    while($row = mysqli_fetch_assoc($result)) {
        $menu = $row['menuName'];
        $quantity = $row['quantity'];
        $totalPrice = $row['totalPrice'];
        $total = $total + $totalPrice;

        $table .= '<tr>
                    <td> ' . $menu . ' </td><td>' . $quantity . '</td><td align="right">' . $totalPrice . '</td>
                </tr>';
    }

    $table .= '<tr>
                    <td colspan="2" align="right">Total:</td>
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
    $dompdf->stream("Billing_Receipt.pdf", array("Attachment" => false));

    exit(0);

?>
