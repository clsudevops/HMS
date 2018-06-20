<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    if(isset($_GET['floor'])){
        $floor = $_GET['floor']; 
        $select = "SELECT * from roomDetails where floor = '". $floor ."' order by roomNo";
        $result = mysqli_query($conn, $select);
    }
    if(isset($_GET['status'])){
        $status = $_GET['status']; 
        $select = "SELECT * from roomDetails where status = '". $status ."' order by roomNo";
        $result = mysqli_query($conn, $select);
    }
    if(isset($_GET['type'])){
        $type = $_GET['type']; 
        $select = "SELECT * from roomDetails where type = '". $type ."' order by roomNo";
        $result = mysqli_query($conn, $select);
    }
    

    

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>