<?php

    require '../../connection.php';
    require '../../vendor/autoload.php';
    use Dompdf\Dompdf;
    
    $dompdf = new Dompdf();
    $dompdf->set_option('defaultFont', 'Courier');

    $checkInId = $_GET['checkInId'];
    
    $stmt = $conn->prepare("Select roomNo, type, floor, rate, rateperhour,
        guestId, name, mobile, companyName, companyAddress , DATE_FORMAT(checkIn,'%M %d, %Y %h:%i:%s %p') as checkInDate,
        DATE_FORMAT(checkIn,'%h:%i:%s %p') As checkInTime, DATE_FORMAT(checkOutDate,'%M %d, %Y') as checkOutDate,
        DATE_FORMAT(checkOutDate,'%h:%i:%s %p') As checkOutTime,
        (case when now() >= checkOutDate then DATEDIFF(now() , checkIn) else DATEDIFF(now() , checkIn) + 1 End) as noOfDays,
        (case when checkOutDate <= now() then Hour(TimeDiff((DATE_FORMAT(now(),'%H:%i:%s')), date_format(DATE_ADD(checkIn, INTERVAL DATEDIFF(now() , checkIn) DAY),'%H:%i:%s'))) else 0 END) as penaltyHours
    from checkInDetails
    where checkInId = ?");

    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $result = $stmt->get_result() or die($conn->error);
    while($row = mysqli_fetch_assoc($result)) {
        $roomNo = $row['roomNo']; $type = $row['type']; $floor = $row['floor'];
        $rate = $row['rate']; $rateperhour = $row['rateperhour']; $guestId = $row['guestId'];
        $name = $row['name']; $mobile = $row['mobile']; $companyName = $row['companyName'];
        $companyAddress = $row['companyAddress']; $checkInDate = $row['checkInDate'];
        $noOfDays = $row['noOfDays']; $penaltyHours = $row['penaltyHours'];
    }
    $daycharge = $noOfDays * $rate;
    $penaltycharge = $penaltyHours * $rateperhour;
    $roomCharge = $daycharge + $penaltycharge;


    // get ornumber and datenow
    $stmt = $conn->prepare("SELECT ORNumber,DATE_FORMAT(now(), '%M %d, %Y %h:%i:%s %p') as dateNow from billing where checkInId = ?");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $result1 = $stmt->get_result() or die($conn->error);

    while($row = mysqli_fetch_assoc($result1)) {
        $ORNumber = $row['ORNumber'];
        $now = $row['dateNow'];
    }

    // header details 
    $header='<div class="header">
                <h2>Billing Receipt</h2>
                <table class="billingReceiptheader">
                    <tr><td style="width:70%;">Guest Name: '. $name .'</td><td style="width:30%;">Room No: '. $roomNo .'</td></tr>
                    <tr><td style="width:70%;">Company Name: '. $companyName .'</td><td style="width:30%;">Room Type: '. $type .'</td></tr>
                    <tr><td style="width:70%;">Contact: '. $mobile .'</td><td style="width:30%;">Rate: '. $rate .' Php</td></tr>
                    <tr><td style="width:70%;">Checkin Date: '. $checkInDate .'</td><td style="width:30%;">Rate/Hour: '. $rateperhour .' Php</td></tr>
                    <tr><td style="width:70%;">Checkout Date: '. $now .'</td><td style="width:30%;">OR Number: '. $ORNumber .'</td></tr>
                </table>
            </div>';

    // table details
    // Room Charges
    $table =  '<h3>Room Charges</h3>
                <table class="orderReceiptTable">
                    <tr class="heading">
                        <td style="padding-bottom:5px; width:60%;">Item Name</td>
                        <td style="padding-bottom:5px; width:20%;" align="right">Quantity</td>
                        <td style="padding-bottom:5px; width:20%;" align="right">Price</td>
                    </tr>
                    <tr>
                        <td>No of Days</td><td align="right">' . $noOfDays . '</td><td align="right">' . $daycharge . '</td>
                    </tr>
                    <tr>
                        <td>Penalty Hours</td><td align="right">' . $penaltyHours . '</td><td align="right">' . $penaltycharge . '</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">Total:</td>
                        <td align="right"><span style="font-family: DejaVu Sans;">&#8369;</span>'. $roomCharge .'</td>
                    </tr>
                </table>';

    // Food Charges
    $stmt = $conn->prepare("SELECT A.id, sum(A.quantity) as quantity, B.menuName, (B.sellingPrice * sum(A.quantity)) as totalPrice from addedfoods A inner join foods B on A.foodsId = B.id where A.checkinId = ? GROUP by A.foodsId");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $foodList = $stmt->get_result() or die($conn->error);

    $table2 = '<h3>Foods Charges</h3><table class="orderReceiptTable">
                
                <tr class="heading">
                    <td style="padding-bottom:5px; width:60%;">Item Name</td>
                    <td style="padding-bottom:5px; width:20%;" align="right">Quantity</td>
                    <td style="padding-bottom:5px; width:20%;" align="right">Price</td>
                </tr>';

    $totalFoods = 0;
    while($row = mysqli_fetch_assoc($foodList)) {
        $menu = $row['menuName'];
        $quantity = $row['quantity'];
        $totalPrice = $row['totalPrice'];
        $totalFoods = $totalFoods + $totalPrice;

        $table2 .= '<tr><td> ' . $menu . ' </td><td align="right">' . $quantity . '</td><td align="right">' . $totalPrice . '</td></tr>';
    }

    $table2 .= '<tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><span style="font-family: DejaVu Sans;">&#8369;</span>'. $totalFoods .'</td>
            </tr>
        </table>';
    
    // Extras Charges
    $stmt = $conn->prepare("select description,quantity,(cost * quantity) as totalprice from addedextras A inner join extras B on A.extrasId = B.id where A.checkinId = ?");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $extrasList = $stmt->get_result() or die($conn->error);

    $table3 = '<h3><Extra>Extras Charges</h3><table class="orderReceiptTable">
                
                <tr class="heading">
                    <td style="padding-bottom:5px; width:60%;">Item Name</td>
                    <td style="padding-bottom:5px; width:20%;" align="right">Quantity</td>
                    <td style="padding-bottom:5px; width:20%;" align="right">Price</td>
                </tr>';


    $totalExtras = 0;
    while($row = mysqli_fetch_assoc($extrasList)) {
        $menu = $row['description'];
        $quantity = $row['quantity'];
        $totalPrice = $row['totalprice'];
        $totalExtras = $totalExtras + $totalPrice;

        $table3 .= '<tr><td> ' . $menu . ' </td><td align="right">' . $quantity . '</td><td align="right">' . $totalPrice . '</td></tr>';
    }

    $table3 .= '<tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><span style="font-family: DejaVu Sans;">&#8369;</span>'. $totalExtras .'</td>
            </tr>
        </table>';

    
    $total = $roomCharge + $totalExtras + $totalFoods;
    $totalSumamry='<div><h2 style="text-align:right;">Total: <span style="font-family: DejaVu Sans;">&#8369;</span>'. $total .'</h2></div>';

    $html="
    <html>
        <head>
        <link type='text/css' href='../../includes/css/dompdf.css' rel='stylesheet' />
        <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
        </head>
        <body>
            <header>" . $header . "</header>
            <main>" . $table . $table2 . $table3 . $totalSumamry ."</main>
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