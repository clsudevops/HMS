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
    <style>
        .select-wrapper input.select-dropdown{
            height:36px;
            line-height:36px;
        }
    </style>
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
                        <h5>Manage Extras</h5>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col s12 m6">
                            <div class="file-field input-field col m12 s12" style="padding-left:0px; padding-right:0px;">
                                <a class="btn right btn-1" id="searchRoomNo" style="margin-left:5px; height:36px; line-height:36px;">
                                    <i class="material-icons left">search</i>Search</a>
            
                                <div class="file-path-wrapper">
                                    <input style="height:36px; line-height:36px;" placeholder="Search Extra" id="search" class="file-path validate myinput" type="text"/>
                                </div>
                            </div>
                            <table class="z-depth-2 responsive-table highlight roomTypeTable">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Cost</th>
                                        <th style="width:25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="extraTable">
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col s12 m6">
                            <div class="input-field col s12 m8" style="margin-bottom:0px;">
                                <label>Description:</label>
                                <input name="description" style="height:36px; line-height:36px;" id="description" type="text" class="validate" required>
                            </div>
                            <div class="input-field col s12 m4" style="margin-bottom:0px;">
                                <label>Cost:</label>
                                <input name="cost" id="cost" style="height:36px; line-height:36px;" type="text" class="validate" required>
                            </div>
                            <div class="input-field col s12 m12">
                                <a class="btn right btn-1" id="submitExtra" style="margin-left:5px; height:36px; line-height:36px;">
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

    <section class="jsIncludes">
        <?php require('jsInclude.php') ?>
        <script type="text/javascript" src="includes/js/extras.js"></script>
    </section>
</body>



</html>