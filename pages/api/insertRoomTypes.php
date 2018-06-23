<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $type = $_POST['type']; 
    $rate = $_POST['rate'];
    
    $stmt = $conn->prepare("Insert Into roomTypes(type,rate) values(?,?)");
    $stmt->bind_param('si', $type,$rate); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>