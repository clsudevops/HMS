<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        include('cssInclude.php');
        if(isset($_SESSION['username'])){
            header("Location:index.php");  
        }
    ?>
</head>

<body>
    <nav style="background-color:#2e2c2c;">
        <div class="nav-wrapper">
            <a href="#" style="margin-left:10px" class="brand-logo">Hotel Management System</a>
        </div>
    </nav>

    <div class="row">
        <div class="col s12 m12">
            <div class="card login-card">
                <div class="card-content">
                <span class="card-title">Pleas Sign In</span>
                <div class="row" style="margin-bottom:10px; margin-top:15px;">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="username" type="text" class="validate">
                        <label for="username">Username</label>
                    </div>
                </div>
                <div class="row" style="margin-bottom:5px;">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">lock</i>
                        <input id="password" type="password" class="validate">
                        <label for="password">Password</label>
                    </div>
                </div>
                </div>
                <div class="card-action">
                    <a class="btn btn-1 right" id="sign_in">Sign In</a>
                </div>
            </div>
        </div>
    </div>
        
</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
    <script type="text/javascript" src="includes/js/login.js"></script>
</section>

</html>