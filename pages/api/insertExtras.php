<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $description = $_POST['description']; 
    $cost = $_POST['cost'];
    
    $stmt = $conn->prepare("Insert Into extras(description,cost) values(?,?)");
    $stmt->bind_param('sd', $description,$cost); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>