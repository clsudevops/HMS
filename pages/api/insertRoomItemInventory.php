<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $roomNo = $_POST['roomNo'];
    $itemDescription = $_POST['itemDescription'];
    $itemQuantity = $_POST['itemQuantity'];
    $quantity = 0;

    $stmt = $conn->prepare("Select quantity from roominventory where description = ? and roomNo = ?");
    $stmt->bind_param('ss', $itemDescription, $roomNo); 
    $stmt->execute();
    
    $result = $stmt->get_result() or die($conn->error);

    while($row = mysqli_fetch_assoc($result)) {
        $quantity = $row['quantity'];
    }

    if($quantity == 0){
        $stmt = $conn->prepare("Insert Into roominventory(roomNo,description,quantity) values(?,?,?)");
        $stmt->bind_param('ssi', $roomNo,$itemDescription,$itemQuantity); 
    }
    else{
        // $itemquantity = intval($itemquantity);
        $quantity = $quantity + $itemQuantity;
        $stmt = $conn->prepare("Update roominventory set quantity = ? where roomNo = ? and description = ?");
        $stmt->bind_param('iss', $quantity,$roomNo,$itemDescription); 
    }
    $stmt->execute();
    $result = $stmt->get_result() or die($conn->error);
    
?>