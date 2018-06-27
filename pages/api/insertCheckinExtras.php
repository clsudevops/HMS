<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $roomNo = $_POST['roomNo']; 
    $extrasId = $_POST['extrasId'];
    $quantity = 0;

    $select = "Select checkInId from checkindetails where roomNo = '". $roomNo ."'";
    $result = mysqli_query($conn, $select);

    while($row = mysqli_fetch_assoc($result)) {
        $checkInId = $row['checkInId'];
    }

    $stmt = $conn->prepare("Select quantity from addedextras where checkInId = ? and extrasId = ?");
    $stmt->bind_param('ii', $checkInId, $extrasId); 
    $stmt->execute();
    
    $result = $stmt->get_result() or die($conn->error);

    while($row = mysqli_fetch_assoc($result)) {
        $quantity = $row['quantity'];
    }

    if($quantity == 0){
        $quantity = 1;
        $stmt = $conn->prepare("Insert Into addedextras(checkinId,extrasId,quantity) values(?,?,?)");
        $stmt->bind_param('iii', $checkInId,$extrasId,$quantity); 
        $stmt->execute();
        $result = $stmt->get_result() or die($conn->error);
    }
    else{
        $quantity = $quantity + 1;
        $stmt = $conn->prepare("Update addedextras set quantity = ? where checkInId = ? and extrasId = ?");
        $stmt->bind_param('iii', $quantity,$checkInId,$extrasId); 
        $stmt->execute();
        $result = $stmt->get_result() or die($conn->error);
    }
    

    // 
?>