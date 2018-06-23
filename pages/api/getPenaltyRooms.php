<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $select = "SELECT *,now() as curdate from roomDetails where DATE_FORMAT(now(), '%Y-%m-%d %T') > DATE_FORMAT(checkoutDate, '%Y-%m-%d %T') order by roomNo";
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>