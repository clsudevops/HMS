<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $username = $_GET['username']; 
    
    if($username != ""){
        $stmt = $conn->prepare("Select * from loginnames where username like ?");
        $stmt->bind_param('i', $username); 
        $stmt->execute();
    }
    else{
        $stmt = $conn->prepare("Select * from loginnames");
        $stmt->execute();
    }
    $result = $stmt->get_result() or die($conn->error);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>