<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $id = $_POST['id'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    
    if($quantity == 0){
        $stmt = $conn->prepare("Delete from roominventory where id = ?");
        $stmt->bind_param('i', $id); 
    }
    else {
        $stmt = $conn->prepare("Update roominventory set quantity = ?, description = ? where id = ?");
        $stmt->bind_param('isi', $quantity,$description,$id); 
    }
    
    $stmt->execute();
    $result = $stmt->get_result() or die($conn->error);
    // $response = [
    //     "status" => "OK",
    //     "data" => $result
    // ];

    // echo json_encode($result);
?>