<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    if($_GET['guestName'] == ""){
        $select = "Select guestId,name,roomNo,DATE_FORMAT(checkIn, '%M %d, %Y') as checkIn,DATE_FORMAT(CheckOutDate, '%M %d, %Y') as checkOutDate from checkindetails order by checkOutDate";
    }
    else{
        $description = $_GET['guestName'];
        $select = "Select guestId,name,roomNo,DATE_FORMAT(checkIn, '%M %d, %Y') as checkIn,DATE_FORMAT(CheckOutDate, '%M %d, %Y') as checkOutDate from checkindetails where name like '%". $description ."%'  order by checkOutDate";
    }

    // $select = "Select * from roomTypes";
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>