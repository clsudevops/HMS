<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    $checkInId = $_GET['checkInId']; 

    // insert into checkout
    $stmt = $conn->prepare("insert into checkout(id,roomNo,guestId,checkin,checkOutDate,adultsCount,childrenCount) Select id,roomNo,guestId,checkin,now(),adultsCount,childrenCount from checkin where id = ?");
    $stmt->bind_param('i', $checkInId); 
    $stmt->execute();

    // update guest status
    $stmt3 = $conn->prepare("update guests set isCheckin = 0 where id = (select guestId from checkin where id = ?)");
    $stmt3->bind_param('i', $checkInId); 
    $stmt3->execute();

    // delete from checkin
    $stmt1 = $conn->prepare("delete from checkin where id = ?");
    $stmt1->bind_param('i', $checkInId); 
    $stmt1->execute();

    // update room status
    $stmt2 = $conn->prepare("update rooms set status = 'Cleaning' where roomNo = (select roomNo from checkout where id = ?)");
    $stmt2->bind_param('s', $checkInId); 
    $stmt2->execute();  
?>