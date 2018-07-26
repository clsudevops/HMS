<?php session_start(); ?>
<?php
    if(!isset($_SESSION['username'])){
        header("Location: ../../login.php");  
    }
    else{
        $username = $_SESSION["username"];
        $type = $_SESSION["type"];
    }
    
    require '../../connection.php';
    require '../../vendor/autoload.php';
    use Dompdf\Dompdf;
    
    $dompdf = new Dompdf();
    $dompdf->set_option('defaultFont', 'Courier');

    $checkInId = $_GET['checkInId'];
    
    $stmt = $conn->prepare("Select roomNo, type, floor, rate, rateperhour, guestId, name, mobile, companyName, companyAddress , DATE_FORMAT(checkIn,'%M %d, %Y %h:%i:%s %p') as checkInDate,
     DATE_FORMAT(checkIn,'%h:%i:%s %p') As checkInTime,
     DATE_FORMAT(checkOutDate,'%M %d, %Y %h:%i:%s %p') as checkOutDate,
     DATE_FORMAT(checkOutDate,'%h:%i:%s %p') As checkOutTime,
     noOfDays,penaltyHours
     from checkoutdetails
    where checkInId = ?");

    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $result = $stmt->get_result() or die($conn->error);
    while($row = mysqli_fetch_assoc($result)) {
        $roomNo = $row['roomNo']; $type = $row['type']; $floor = $row['floor'];
        $rate = $row['rate']; $rateperhour = $row['rateperhour']; $guestId = $row['guestId'];
        $name = $row['name']; $mobile = $row['mobile']; $companyName = $row['companyName'];
        $companyAddress = $row['companyAddress']; $checkInDate = $row['checkInDate'];
        $checkOutDate = $row['checkOutDate'];
        $noOfDays = $row['noOfDays']; $penaltyHours = $row['penaltyHours'];
    }
 
    // get ornumber and datenow
    $stmt = $conn->prepare("SELECT ORNumber,DATE_FORMAT(now(), '%M %d, %Y %h:%i:%s %p') as dateNow from billing where checkInId = ?");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();


    $result1 = $stmt->get_result() or die($conn->error);

    while($row = mysqli_fetch_assoc($result1)) {
        $ORNumber = $row['ORNumber'];
        $now = $row['dateNow'];
    }

    $daycharge = $noOfDays * $rate;
    $penaltycharge = $penaltyHours * $rateperhour;
    $roomCharge = $daycharge + $penaltycharge;

    // update checkoutdate in checkout
    // $stmt4 = $conn->prepare("update checkout set checkOutDate = now() where id = ?");
    // $stmt4->bind_param('i', $checkInId); 
    // $stmt4->execute();

    // header details 
    $header='<div class="header">
                <h2>Billing Receipt</h2>
                <table class="billingReceiptheader">
                    <tr><td style="width:70%;">Guest Name: '. $name .'</td><td style="width:30%;">Room No: '. $roomNo .'</td></tr>
                    <tr><td style="width:70%;">Company Name: '. $companyName .'</td><td style="width:30%;">Room Type: '. $type .'</td></tr>
                    <tr><td style="width:70%;">Contact: '. $mobile .'</td><td style="width:30%;">Rate: '. $rate .' Php</td></tr>
                    <tr><td style="width:70%;">Checkin Date: '. $checkInDate .'</td><td style="width:30%;">Rate/Hour: '. $rateperhour .' Php</td></tr>
                    <tr><td style="width:70%;">Checkout Date: '. $checkOutDate .'</td><td style="width:30%;">OR Number: '. $ORNumber .'</td></tr>
                </table>
            </div>';

    // table details
    // Room Charges
    $table =  '<h3>Room Charges</h3>
                <table class="orderReceiptTable">
                    <tr class="heading">
                        <td style="padding-bottom:5px; width:50%;">Item Name</td>
                        <td style="padding-bottom:5px; width:10%;" align="right">Quantity</td>
                        <td style="padding-bottom:5px; width:20%;" align="right">Price</td>
                        <td style="padding-bottom:5px; width:20%;" align="right">Total</td>
                    </tr>
                    <tr>
                        <td>No of Days</td><td align="right">' . $noOfDays . '</td><td align="right">' . $rate . '</td><td align="right">' . $daycharge . '</td>
                    </tr>
                    <tr>
                        <td>Penalty Hours</td><td align="right">' . $penaltyHours . '</td><td align="right">' . $rateperhour . '</td><td align="right">' . $penaltycharge . '</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Total:</td>
                        <td align="right"><span style="font-family: DejaVu Sans;">&#8369;</span>'. $roomCharge .'</td>
                    </tr>
                </table>';

    // Food Charges
    $stmt = $conn->prepare("SELECT A.id, sum(A.quantity) as quantity, B.menuName,sellingPrice, (B.sellingPrice * sum(A.quantity)) as totalPrice from addedfoods A inner join foods B on A.foodsId = B.id where A.checkinId = ? GROUP by A.foodsId");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $foodList = $stmt->get_result() or die($conn->error);

    $table2 = '<h3>Foods Charges</h3><table class="orderReceiptTable">
                
                <tr class="heading">
                    <td style="padding-bottom:5px; width:50%;">Item Name</td>
                    <td style="padding-bottom:5px; width:10%;" align="right">Quantity</td>
                     <td style="padding-bottom:5px; width:20%;" align="right">Price</td>
                    <td style="padding-bottom:5px; width:20%;" align="right">Total</td>
                </tr>';

    $totalFoods = 0;
    while($row = mysqli_fetch_assoc($foodList)) {
        $menu = $row['menuName'];
        $quantity = $row['quantity'];
        $sellingPrice = $row['sellingPrice'];
        $totalPrice = $row['totalPrice'];
        $totalFoods = $totalFoods + $totalPrice;

        $table2 .= '<tr><td> ' . $menu . ' </td><td align="right">' . $quantity . '</td><td align="right">' . $sellingPrice . '</td><td align="right">' . $totalPrice . '</td></tr>';
    }

    $table2 .= '<tr>
                <td colspan="3" align="right">Total:</td>
                <td align="right"><span style="font-family: DejaVu Sans;">&#8369;</span>'. $totalFoods .'</td>
            </tr>
        </table>';
    
    // Extras Charges
    $stmt = $conn->prepare("select description,quantity,cost,(cost * quantity) as totalprice from addedextras A inner join extras B on A.extrasId = B.id where A.checkinId = ?");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $extrasList = $stmt->get_result() or die($conn->error);

    $table3 = '<h3><Extra>Extras Charges</h3><table class="orderReceiptTable">
                
                <tr class="heading">
                    <td style="padding-bottom:5px; width:50%;">Item Name</td>
                    <td style="padding-bottom:5px; width:10%;" align="right">Quantity</td>
                     <td style="padding-bottom:5px; width:20%;" align="right">Price</td>
                    <td style="padding-bottom:5px; width:20%;" align="right">Total</td>
                </tr>';


    $totalExtras = 0;
    while($row = mysqli_fetch_assoc($extrasList)) {
        $menu = $row['description'];
        $quantity = $row['quantity'];
        $sellingPrice = $row['cost'];
        $totalPrice = $row['totalprice'];
        $totalExtras = $totalExtras + $totalPrice;

        $table3 .= '<tr><td> ' . $menu . ' </td><td align="right">' . $quantity . '</td><td align="right">' . $sellingPrice . '</td><td align="right">' . $totalPrice . '</td></tr>';
    }

    $table3 .= '<tr>
                <td colspan="3" align="right">Total:</td>
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

    // $stmt1 = $conn->prepare("update billing set collection = ?, date_collected = DATE_FORMAT(now(),'%Y-%m-%d %H:%i:%s') where checkinId = ?");
    // $stmt1->bind_param('di', $total,$checkInId); 
    // $stmt1->execute();

    $dompdf->loadHtml($html);

    // Food Charges
    

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("Billing_Receipt.pdf", array("Attachment" => false));

    exit(0);

?>
