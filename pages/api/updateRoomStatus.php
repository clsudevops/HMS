<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $roomNo = $_POST['roomNo'];
    $status = $_POST['status'];
    
    $stmt = $conn->prepare("Update rooms set status = ? where roomNo = ?");
    $stmt->bind_param('ss', $status,$roomNo); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
    // $response = [
    //     "status" => "OK",
    //     "data" => $result
    // ];

    // echo json_encode($result);
?>