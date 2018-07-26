<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        include('cssInclude.php');
        if(!isset($_SESSION['username'])){
            header("Location:login.php");  
        }
        else{
            if($_SESSION["type"] != 'admin'){
                header("Location:index.php"); 
            }
            else{
                $username = $_SESSION["username"];
                $type = $_SESSION["type"];
            }
        }
    ?>
</head>

<body>
    <header>
        <?php require('pages/layout/navbar.php') ?>
        <?php require('pages/layout/sidenav.php') ?>
    </header>
    
    <main>
        <div class="row">
            <div class="col s12">
                <div class="card-1">
                    <div class="page-header valign-wrapper z-depth-1">
                        <h5>Manage Accounts</h5>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col s12 m6">
                            <div class="file-field input-field col m12 s12" style="padding-left:0px; padding-right:0px;">
                                <a class="btn right btn-1" id="searchRoomType" style="margin-left:5px; height:36px; line-height:36px;">
                                    <i class="material-icons left">search</i>Search</a>
            
                                <div class="file-path-wrapper">
                                    <input style="height:36px; line-height:36px;" placeholder="Search User" id="search" class="file-path validate myinput" type="text"/>
                                </div>
                            </div>
                            <table class="z-depth-2 highlight roomTypeTable">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Account Type</th>
                                        <th style="width:30%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="accountsTable">
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col s12 m6">
                            <div class="input-field col s12 m6" style="margin-bottom:0px;">
                                <label>UserName:</label>
                                <input name="userName" style="height:36px; line-height:36px;" id="userName" type="text" class="validate" required>
                            </div>
                            <div class="input-field col s12 m6" style="margin-bottom:0px;">
                                <label>Password:</label>
                                <input name="passWord" style="height:36px; line-height:36px;" id="passWord" type="password" class="validate" required>
                            </div>
                            <div class="input-field col s12 m6 test1" style="margin-bottom:0px;">
                                <select id="accountType" style="height:36px; line-height:36px;">
                                    <option value="" disabled selected>Account Type</option>  
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                            <div class="input-field col s12 m6" style="margin-bottom:0px;">
                                <label>Confirm Password:</label>
                                <input name="confirmPassWord" style="height:36px; line-height:36px;" id="confirmPassWord" type="password" class="validate" required>
                            </div>

                            <div class="input-field col s12 m12">
                                <a class="btn right btn-1" id="submitAccount" style="margin-left:5px; height:36px; line-height:36px;">
                                    <i class="material-icons left" style="margin-right:10px;">
                                        send
                                    </i>
                                    Submit
                                </a>
                            </div>
                        </div>
                    </div>  
                </div>
            </div>
        </div>
        
    <!-- Modal Structure -->

    </main>
    
    <footer>
        <?php require('pages/layout/footer.php') ?>
        <!-- modals -->
    </footer>
    
</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
    <script type="text/javascript" src="includes/js/accounts.js"></script>
</section>

</html>