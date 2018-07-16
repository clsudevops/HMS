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
            <div class="col s12 mycontainer">
                <div class="card-1">
                    <!-- query for roomtype -->
                    <?php
                        $sql = "SELECT type from roomtypes";
                        $result = mysqli_query($conn, $sql);
                    ?>
                    <div class="page-header valign-wrapper z-depth-1">
                        <h5>Room Management</h5>
                    </div>
                    <!-- Filterings -->
                    <div class="row"  style="margin-bottom:10px;">
                        <div class="file-field input-field col m6 s12">
                            <a class="waves-effect waves btn right btn-1" href="" style="margin-left:5px;">
                                <i class="material-icons left">search</i>Search</a>
        
                            <div class="file-path-wrapper">
                                <input placeholder="Search Room No" id="search" class="file-path validate myinput" type="text" required />
                            </div>
                        </div>
                        <div class="input-field col m3 s12">
                            <select id="typeSelect">
                                <option value="1" disabled selected>Room Type</option>
                                <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value=" . $row["type"] .">". $row["type"] . "</option>";
                                        }
                                    }
                                ?> 
                            </select>
                        </div>
                        <div class="input-field col m3 s12">
                            <select id="floorSelect">
                                <option value="" disabled selected>Floor</option>
                                <?php
                                    for($i = 1 ; $i <= 11 ; $i++){
                                        echo "<option value=" . $i . ">" . $i . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="z-depth-2 highlight responsive-table roomTypeTable">
                        <thead>
                            <tr>
                                <th>Room No.</th>
                                <th>Room Type</th>
                                <th>Floor</th>
                                <th>Rate</th>
                                <th>Status</th>
                                <th style="width:25%">Change Status</th>
                            </tr>
                        </thead>
                        <tbody id="roomManagementTable">
                            
                        </tbody>
                    </table>
                    <!-- <ul class="pagination right">
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li class="waves-effect"><a href="#!">2</a></li>
                        <li class="waves-effect"><a href="#!">3</a></li>
                        <li class="waves-effect"><a href="#!">4</a></li>
                        <li class="waves-effect"><a href="#!">5</a></li>
                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    </ul> -->
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
    <script type="text/javascript" src="includes/js/roomManagement.js"></script>
</section>

</html>