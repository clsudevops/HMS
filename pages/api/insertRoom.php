<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $roomNo = $_POST['roomNo'];
    $roomType = $_POST['roomType'];
    $roomFloor = $_POST['roomFloor'];
    
    $stmt = $conn->prepare("Insert Into rooms(roomNo,roomType,floor) values(?,?,?)");
    $stmt->bind_param('sii', $roomNo,$roomType,$roomFloor); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>