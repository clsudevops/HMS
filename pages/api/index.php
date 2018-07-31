<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "hms";

    $conn = mysqli_connect($servername, $username, $password,$db);

    if(isset($_GET['page'])){
        $page = $_GET['page'] - 1;
        $limit = 10;
        $offset = ($page * $limit);
    }
?>