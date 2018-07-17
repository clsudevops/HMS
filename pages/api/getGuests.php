<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    $select = "Select id,name,mobile,companyName,companyAddress,roomNo,floor,DATE_FORMAT(checkin, '%M %d, %Y') as checkin,DATE_FORMAT(CheckOutDate, '%M %d, %Y') as checkOutDate from guestdetails where isCheckIn = 1";
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>