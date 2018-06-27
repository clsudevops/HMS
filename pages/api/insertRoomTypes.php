<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $type = $_POST['type'];
    $maxAdult = $_POST['maxAdult']; 
    $maxChildren = $_POST['maxChildren']; 
    // $rate = $_POST['rate'];
    
    $stmt = $conn->prepare("Insert Into roomTypes(type,maxAdult,maxChildren) values(?,?,?)");
    $stmt->bind_param('sii', $type,$maxAdult,$maxChildren); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>