<?php
    require("index.php");

    $pagination = "LIMIT ". $limit ." OFFSET ". $offset ."";
    
    if($_GET['type'] == ""){
        $select = "Select * from roomTypes order by dateCreated desc ";
    }
    else{
        $type = $_GET['type'];
        $select = "Select * from roomTypes where type like '%". $type ."%' order by dateCreated desc ";
    }

    $select .= $pagination; 
    $result = mysqli_query($conn, $select);

    $rows = array();
    while($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
?>