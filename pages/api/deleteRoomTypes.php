<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $id = $_POST['id']; 
    
    $stmt = $conn->prepare("Delete from roomtypes where id = ?");
    $stmt->bind_param('i', $id); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>