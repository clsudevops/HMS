<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $roomNo = $_POST['roomNo'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $compName = $_POST['compName'];
    $compAddress = $_POST['compAddress'];
    $checkInDate = $_POST['checkInDate'];
    $checkOutDate = $_POST['checkOutDate'];
    $adultsCount = $_POST['adultsCount'];
    $childrensCount = $_POST['childrensCount'];
    $personal_id_type = $_POST['personal_id_type'];
    $personal_id = $_POST['personal_id'];
    
    $checkInDate = date('Y-m-d' , strtotime($checkInDate));
    $checkOutDate = date('Y-m-d' , strtotime($checkOutDate));

    $stmt = $conn->prepare("Insert Into reservations(personal_id,personal_id_type,roomNo,name,mobile,compName,compAddress,checkInDate,checkOutDate,adultsCount,childrensCount) values(?,?,?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param('sssssssssii', $personal_id,$personal_id_type,$roomNo,$name,$mobile,$compName,$compAddress,$checkInDate,$checkOutDate,$adultsCount,$childrensCount); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>