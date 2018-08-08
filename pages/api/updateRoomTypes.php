<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $id = $_POST['id'];
    $type = $_POST['type'];
    $maxAdult = $_POST['maxAdult'];
    $maxChildren = $_POST['maxChildren'];
    $rate = $_POST['rate'];
    $rateperhour = $_POST['rateperhour'];

    $stmt = $conn->prepare("Update roomtypes set type = ?, maxAdult = ?, maxChildren = ?, rate = ?, rateperhour = ?  where id = ?");
    $stmt->bind_param('siiddi', $type,$maxAdult,$maxChildren,$rate,$rateperhour,$id); 
    $stmt->execute();

    $stmt = $conn->prepare("Insert into rate_history(rate,rateperhour) values(?,?)");
    $stmt->bind_param('dd', $rate,$rateperhour); 
    $stmt->execute();

    $stmt = $conn->prepare("Update roomtypes set raterefno = (select max(refno) from rate_history)  where id = ?");
    $stmt->bind_param('i', $id); 
    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>