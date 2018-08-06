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
    $rate = $_POST['rate']; 
    $rateperhour = $_POST['rateperhour'];  
    // $rate = $_POST['rate'];
    
    $stmt = $conn->prepare("Insert Into rate_history(rate,rateperhour) values(?,?)");
    $stmt->bind_param('dd', $rate,$rateperhour); 
    $stmt->execute();

    $stmt = $conn->prepare("Insert Into roomTypes(type,maxAdult,maxChildren,rate,rateperhour) values(?,?,?,?,?)");
    $stmt->bind_param('siidd', $type,$maxAdult,$maxChildren,$rate,$rateperhour); 
    $stmt->execute();

    $stmt = $conn->prepare("Update roomTypes set raterefno = (select max(refno) from rate_history) order by dateCreated desc limit 1");
    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>