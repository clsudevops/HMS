<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    $roomNo = $_POST['roomNo']; 

    $select = "Select checkInId from checkindetails where roomNo = '". $roomNo ."'";
    $result = mysqli_query($conn, $select);

    while($row = mysqli_fetch_assoc($result)) {
        $checkInId = $row['checkInId'];
    }

    $stmt = $conn->prepare("Select A.id, A.checkinId , A.extrasId, A.quantity, B.description, B.cost from addedextras A inner join extras B on A.extrasId = B.id where checkInId = ?");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $result = $stmt->get_result() or die($conn->error);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>