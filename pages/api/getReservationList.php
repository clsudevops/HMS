<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    if($_GET['search'] == ""){
        $select = "Select reservationId,personal_id, personal_id_type, roomNo, name, mobile,compName,compAddress, DATE_FORMAT(checkInDate, '%M %d, %Y') as checkInDate,
        DATE_FORMAT(checkOutDate, '%M %d, %Y') as checkOutDate, adultsCount, childrensCount, reservationDate from reservations order by checkIndate";
    }
    else{
        $search = $_GET['search'];
        $select = "Select * from reservations where roomNo like '". $search ."%' or name like '". $search ."%' order by checkIndate";
    }

    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>