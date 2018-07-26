<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $id = $_POST['id']; 
    
    $stmt = $conn->prepare("Delete from loginnames where username = ?");
    $stmt->bind_param('s', $id); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>