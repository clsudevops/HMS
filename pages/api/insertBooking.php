<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $id = $_POST['reservationId']; 
    $roomNo = $_POST['roomNo']; 
    $checkOutDate = $_POST['checkOutDate'];
    $adultsCount = $_POST['adultsCount'];
    $childrensCount = $_POST['childrensCount'];

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $compName = $_POST['compName']; 
    $compAddress = $_POST['compAddress'];

    $stmt = $conn->prepare("Insert into guests(name,mobile,companyName,companyAddress) values(?,?,?,?)");
    $stmt->bind_param('ssss', $name,$mobile,$compName,$compAddress); 
    $stmt->execute();

    $stmt = $conn->prepare("Insert into checkin(roomNo,guestId,checkOutDate,adultsCount,childrenCount) values(?,(select max(id) as id from guests),?,?,?)");
    $stmt->bind_param('ssii', $roomNo,$checkOutDate,$adultsCount,$childrensCount); 
    $stmt->execute();

    $stmt = $conn->prepare("update rooms set status = 'Occupied' where roomNo = ?");
    $stmt->bind_param('s', $roomNo); 
    $stmt->execute();

    $stmt = $conn->prepare("update reservations set status = 'CheckedIn' where reservationId = ?");
    $stmt->bind_param('i', $id); 
    $stmt->execute();
?>