<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    $query = $_POST['query']; 

    $stmt = $conn->prepare($query);
    // $stmt->bind_param('i', $checkInId); 
    $stmt->execute();
    
    $result = $stmt->get_result() or die($conn->error);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>