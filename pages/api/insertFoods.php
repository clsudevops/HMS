<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password,$db);

    $menuName = $_POST['menuName'];
    $servings = $_POST['servings'];
    $cost = $_POST['cost'];
    $price = $_POST['price'];
    $status = "Available";
    
    $stmt = $conn->prepare("Insert Into foods(menuName,servings,cost,sellingPrice,status) values(?,?,?,?,?)");
    $stmt->bind_param('sidds', $menuName,$servings,$cost,$price,$status); 

    $stmt->execute();

    $result = $stmt->get_result() or die($conn->error);
?>