<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("select * from loginNames where username = ? and password = ?");
    $stmt->bind_param('ss', $username, $password); 
    $stmt->execute();
    
    $result = $stmt->get_result() or die($conn->error);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>