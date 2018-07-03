<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    header('Content-Type: text/plain');
    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $roomNo = $_POST['roomNo'];
    $roomType = $_POST['roomType'];
    $roomFloor = $_POST['roomFloor'];
    $rate = $_POST['rate'];
    $rateperhour = $_POST['rateperhour'];
    $forUpdate = false;
    

    $stmt = $conn->prepare("Select * from rooms where roomNo = ?");
    $stmt->bind_param('s', $roomNo); 
    $stmt->execute();
    $result = $stmt->get_result() or die($conn->error);

    while($row = mysqli_fetch_assoc($result)) {
        $forUpdate = true;
    }

    if($forUpdate == true){
        $stmt = $conn->prepare("Update rooms set roomType = ? , floor = ? , rate = ? , rateperhour = ? where roomNo = ?");
        $stmt->bind_param('iidds', $roomType,$roomFloor,$rate,$rateperhour,$roomNo); 
        $stmt->execute();
        $result = $stmt->get_result() or die($conn->error);
        // $response = "Update";
    }
    else{
        $stmt = $conn->prepare("Insert Into rooms(roomNo,roomType,floor,rate,rateperhour) values(?,?,?,?,?)");
        $stmt->bind_param('siidd', $roomNo,$roomType,$roomFloor,$rate,$rateperhour); 
        $stmt->execute();
        $result = $stmt->get_result() or die($conn->error);
        // $response = "Insert";
    }
    
    // return $response;
?>