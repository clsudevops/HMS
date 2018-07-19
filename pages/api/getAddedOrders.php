<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    $roomNo = $_GET['roomNo']; 

    $select = "Select checkInId from checkindetails where roomNo = '". $roomNo ."'";
    $result = mysqli_query($conn, $select);

    while($row = mysqli_fetch_assoc($result)) {
        $checkInId = $row['checkInId'];
    }

    $stmt = $conn->prepare("SELECT A.id, sum(A.quantity) as quantity, B.menuName, (B.sellingPrice * sum(A.quantity)) as totalPrice,remaining from addedfoods A inner join foods B on A.foodsId = B.id where A.checkinId = ? GROUP by A.foodsId");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $result = $stmt->get_result() or die($conn->error);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>