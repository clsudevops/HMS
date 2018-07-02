<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    $occupied = true;

    $id = $_POST['id']; 
    $stmt = $conn->prepare("select * from rooms where roomNo = ? and status != 'Occupied'");
    $stmt->bind_param('i', $id); 
    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
    while($row = mysqli_fetch_assoc($result)) {
        $occupied = false;
    }

    if($occupied == false){
        $stmt = $conn->prepare("Delete from rooms where roomNo = ?");
        $stmt->bind_param('i', $id); 

        $stmt->execute();

        $result = $stmt->get_result() or die($conn->error);
    }

    echo json_encode($response_array);
?>