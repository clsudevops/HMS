<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    $select = "Select A.id,name,mobile,companyName,companyAddress,B.roomNo,floor,
    DATE_FORMAT(checkin, '%M %d, %Y') as checkin,
    DATE_FORMAT(CheckOutDate, '%M %d, %Y') as checkOutDate from guests
    A inner join checkout B on A.id = B.guestId Inner Join rooms C on B.roomNo = C.roomNo
    where isCheckIn = 0";
    
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>