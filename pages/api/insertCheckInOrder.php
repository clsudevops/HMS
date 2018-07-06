<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $roomNo = $_POST['roomNo']; 
    $foodsId = $_POST['foodsId'];
    $quantity = $_POST['quantity'];
    $newCount = $_POST['newCount'];

    $select = "Select checkInId from checkindetails where roomNo = '". $roomNo ."'";
    $result = mysqli_query($conn, $select);

    while($row = mysqli_fetch_assoc($result)) {
        $checkInId = $row['checkInId'];
    }

    $stmt = $conn->prepare("Insert Into addedfoods(checkinId,foodsId,quantity) values(?,?,?)");
    $stmt->bind_param('iii', $checkInId,$foodsId,$quantity); 
    $stmt->execute();

    $stmt = $conn->prepare("update foods set remaining = ? where id = ?");
    $stmt->bind_param('ii', $newCount,$foodsId); 
    $stmt->execute();

?>