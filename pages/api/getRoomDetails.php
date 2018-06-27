<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    if($_GET['roomNo'] == ""){
        $select = "Select * from roomdetails order by createdDate asc";
    }
    else{
        $roomNo = $_GET['roomNo'];
        $select = "Select * from roomdetails where roomNo = '". $roomNo ."' order by createdDate desc";
    }

    // $select = "SELECT * from roomdetails order by createdDate desc";

    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>