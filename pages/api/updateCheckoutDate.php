<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $checkInId = $_POST['checkInId'];
    $newCheckOutDate = $_POST['newCheckOutDate'];
    
    $stmt = $conn->prepare("Update checkin set checkOutDate = ? where id = ?");
    $stmt->bind_param('si', $newCheckOutDate,$checkInId); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>