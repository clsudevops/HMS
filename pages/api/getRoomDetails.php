<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $room_no = $_GET['roomNo'];

    $select = "SELECT A.type, B.floor, A.beds, A.rate FROM roomtypes A inner Join rooms B on A.id = B.roomtype where B.roomNo = '". $room_no ."'";
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>