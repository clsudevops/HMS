<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    if($_GET['menu'] == ""){
        $select = "Select * from foods";
    }
    else{
        $menu = $_GET['menu'];
        $select = "Select * from foods where menuName like '". $menu ."%'";
    }

    // $select = "Select * from roomTypes";
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>