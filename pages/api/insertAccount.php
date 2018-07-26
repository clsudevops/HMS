<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $userName = $_POST['userName']; 
    $passWord = $_POST['passWord'];
    $accountType = $_POST['accountType'];
    
    $stmt = $conn->prepare("Insert Into loginnames(username, password, accountType) values(?,?,?)");
    $stmt->bind_param('sss', $userName,$passWord,$accountType); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>