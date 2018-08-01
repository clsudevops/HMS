<?php
    session_start();
    
    $_SESSION["username"] = $_POST['username'];
    $_SESSION["type"] = $type = $_POST['type'];
?>