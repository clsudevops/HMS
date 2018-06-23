<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    if($_GET['type'] == ""){
        $select = "Select * from roomTypes";
    }
    else{
        $type = $_GET['type'];
        $select = "Select * from roomTypes where type like '%". $type ."%'";
    }

    // $select = "Select * from roomTypes";
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>