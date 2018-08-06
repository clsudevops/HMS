<?php
    require("index.php");
    
    if($_GET['roomTypeID'] != ""){
        $roomTypeID = $_GET['roomTypeID'];
        $stmt = $conn->prepare("Select rate,rateperhour from roomTypes where id = ?");
        $stmt->bind_param('i', $roomTypeID); 
        $stmt->execute();
        $result = $stmt->get_result() or die($conn->error);
    }

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>