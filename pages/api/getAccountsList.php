<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $username = $_GET['username']; 
    
    if($username != ""){
        $select = "Select * from loginnames where username like  '%". $username ."%'";
        // $result = mysqli_query($conn, $select);
        // $stmt->bind_param('s', $username); 
        // $stmt->execute();
    }
    else{
        $select = "Select * from loginnames where username like  '%". $username ."%'";
        
    }
    $result = mysqli_query($conn, $select);
    // $result = $stmt->get_result() or die($conn->error);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>