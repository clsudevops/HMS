<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $checkInId = $_POST['checkInId']; 
    $foodsId = $_POST['foodsId'];
    $quantity = $_POST['quantity'];
    $newCount = $_POST['newCount'];

    $stmt = $conn->prepare("update addedfoods set quantity = ? where id = ? and checkinId = ?");
    $stmt->bind_param('iis', $quantity,$foodsId,$checkInId); 
    $stmt->execute();

    $stmt = $conn->prepare("update foods set remaining = ? where id = (select foodsId from addedfoods where id = ?)");
    $stmt->bind_param('ii', $newCount,$foodsId); 
    $stmt->execute();

?>