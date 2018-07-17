<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    $roomNo = $_GET['roomNo']; 

    $select = "Select checkInId from checkindetails where roomNo = '". $roomNo ."'";
    $result = mysqli_query($conn, $select);

    while($row = mysqli_fetch_assoc($result)) {
        $checkInId = $row['checkInId'];
    }

    // insert into checkout
    $stmt = $conn->prepare("insert into checkout Select * from checkin where id = ?");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();

    // update guest status
    $stmt3 = $conn->prepare("update guests set isCheckin = 0 where id = (select guestId from checkin where roomNo = ?)");
    $stmt3->bind_param('s', $roomNo); 
    $stmt3->execute();

    // delete from checkin
    $stmt1 = $conn->prepare("delete from checkin where id = ?");
    $stmt1->bind_param('i', $checkInId); 
    $stmt1->execute();

    // update room status
    $stmt2 = $conn->prepare("update rooms set status = 'Cleaning' where roomNo = ?");
    $stmt2->bind_param('s', $roomNo); 
    $stmt2->execute();

    
?>