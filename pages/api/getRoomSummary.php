<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);


    $select = "SELECT (select count(status) from roomDetails where status ='Vacant') as Vacant,
                (select count(status) from roomDetails where status ='Occupied') as Occupied,
                (select count(status) from roomDetails where status ='Cleaning') as Cleaning,
                (select count(status) from roomDetails where status ='Maintenance') as Maintenance,
                (select count(*) from roomDetails where DATE_FORMAT(checkoutDate, '%Y-%m-%d') = DATE_FORMAT(curdate(), '%Y-%m-%d')) as TodaysCheckout";
                
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>