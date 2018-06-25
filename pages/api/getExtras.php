<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    if($_GET['description'] == ""){
        $select = "Select * from extras";
    }
    else{
        $description = $_GET['description'];
        $select = "Select * from extras where description like '%". $description ."%'";
    }

    // $select = "Select * from roomTypes";
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>