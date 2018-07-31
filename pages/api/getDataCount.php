<?php
    require("index.php");

    $tableName = $_GET['tableName'];
    $filtering = $_GET['filtering'];
    
    $select = "Select count(*) as count from " . $tableName . " where " . $filtering;
    // echo $select;
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>