<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    if(isset($_GET['roomNo'])){
        if($_GET['roomNo'] != ""){
            $roomNo = $_GET['roomNo'];
            $select = "Select * from roomdetails where roomNo = '". $roomNo ."' and status != 'Occupied'";
        }
        else{
            $select = "Select * from roomdetails where status != 'Occupied'";
        }
    }

    if(isset($_GET['type'])){
        $type = $_GET['type'];
        $select = "Select * from roomdetails where status != 'Occupied' and type='". $type ."'";
    }

    if(isset($_GET['floor'])){
        $floor = $_GET['floor'];
        $select = "Select * from roomdetails where status != 'Occupied' and floor='". $floor ."'";
    }


    // $select = "SELECT * from roomdetails order by createdDate desc";

    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>