<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    if($_GET['search'] == ""){
        $select = "Select * from reservations order by checkIndate";
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