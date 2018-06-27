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
    $rate = $_POST['rate'];
    $rateperhour = $_POST['rateperhour'];
    
    $stmt = $conn->prepare("Insert Into rooms(roomNo,roomType,floor,rate,rateperhour) values(?,?,?,?,?)");
    $stmt->bind_param('siidd', $roomNo,$roomType,$roomFloor,$rate,$rateperhour); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>