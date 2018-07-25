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
            $username = $_SESSION["username"];
            $type = $_SESSION["type"];
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
            <div class="col s12 mycontainer checkInContainer">
                <div class="card-1">
                    <div class="page-header valign-wrapper z-depth-1" style="margin-bottom:15px;">
                        <h5>Collections</h5>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m4" style="margin:5px 0px;">
                            <label>Search:</label>
                            <input placeholder="Search for OR#" name="search" id="search" type="text">
                        </div>
                        <div class="input-field col s6 m2" style="margin:5px 0px;">
                            <label>Date Filter:</label>
                            <input placeholder="From" name="from" id="from" type="text" class="datepicker">
                        </div>
                        <div class="input-field col s6 m2" style="margin:5px 0px;">
                            <label></label>
                            <input placeholder="To" name="to" id="to" type="text" class="datepicker">
                        </div>
                        <div class="input-field col s12 m2" style="margin:5px 0px;">
                            <a class="btn btn-1" onclick="changeQuery()" style="margin-top:23px;">
                                <i class="material-icons left">
                                    send
                                </i>
                                Filter
                            </a>
                        </div>
                        <div class="col s12 m12 valign-wrapper" style="margin:15px 0;">
                            <h5 id="collectionTitle" style="margin:0;">Today's Collections</h5>
                            <a class="btn btn-1" onclick="printCollection()" style="position:absolute; right:20px;"><i class="material-icons left">print</i>Print</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s12 m12">
                            <table class="z-depth-2 responsive-table highlight roomTypeTable">
                                <thead>
                                    <tr>
                                        <th>Room#</th>
                                        <th>OR#</th>
                                        <th>Amount</th>
                                        <th>Date Collected</th>
                                        <th style="width:10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="collectionTable">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    <!-- Modal Structure -->
        
    </main>
    
    <footer>
        <?php require('pages/layout/footer.php') ?>
    </footer>
</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
    <script type="text/javascript" src="includes/js/collections.js"></script>
</section>

</html>