<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $checkInId = $_POST['checkInId']; 
    $foodsId = $_POST['foodsId'];
    $quantity = $_POST['quantity'];
    $newCount = $_POST['newCount'];

    $stmt1 = $conn->prepare("Select sum(quantity) as total from addedfoods where checkinId = ? and foodsId = ? group by checkinId,foodsId");
    $stmt1->bind_param('ii', $checkInId,$foodsId); 
    $stmt1->execute();

    $result = $stmt1->get_result() or die($conn->error);

    while($row = mysqli_fetch_assoc($result)) {
        $checking = $row['total'];
        $newquantity = $checking + $quantity;
    }

    if($checking > 0){
        $stmt2 = $conn->prepare("Update addedfoods set quantity = ? where checkinId = ? and foodsId = ?");
        $stmt2->bind_param('iii', $newquantity,$checkInId,$foodsId); 
        $stmt2->execute();
    }
    else{
        $stmt = $conn->prepare("Insert Into addedfoods(checkinId,foodsId,quantity) values(?,?,?)");
        $stmt->bind_param('iii', $checkInId,$foodsId,$quantity); 
        $stmt->execute();
    }
    

    $stmt = $conn->prepare("update foods set remaining = ? where id = ?");
    $stmt->bind_param('ii', $newCount,$foodsId); 
    $stmt->execute();

?>