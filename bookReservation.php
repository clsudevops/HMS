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
                        <h5>Book Reservation</h5>
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
                                <th>Room Type</th>
                                <th>Available</th>
                                <th style="width:20%">Action</th>
                            </tr>
                        </thead>
                        <tbody id="roomManagementTable">
                            
                        </tbody>
                    </table>
                    <!-- <ul class="pagination right">
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li class="waves-effect"><a href="#!">2</a></li>
                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    </ul> -->
                </div>
            </div>
        </div>
        
    
        
    </main>
    
    <footer>
        <?php require('pages/layout/footer.php') ?>
    </footer>


</body>
    <!-- Modal Structure -->
        <div id="addReservation" class="modal">
            <div class="modal-content" style="min-height:70vh">
                <h4 id="h4-roomNo">Add Reservation to Room <span id="modalRoomNo"></span></h4>
                <div class="row reservation_modal">
                    <div class="col s12 m12" style="margin:10px 0; padding-left:0;">
                        <label><input class="with-gap" id="forPersonal" name="group1" type="radio" checked /><span>Personal Business</span></label>
                        <label><input class="with-gap" id="forCompany" name="group1" type="radio"/><span>Charge to Company</span></label>
                    </div>
                    <div class="input-field col s12 m6">
                        <label>Name</label>
                        <input style="height:36px; line-height:36px;" id="name" name="name" type="text" class="validate">                        
                    </div>
                    <div class="input-field col s12 m6">
                        <label>Contact</label>
                        <input style="height:36px; line-height:36px;" id="contact" name="mobile" type="text" class="validate">
                    </div>
                    <div class="forCompanyDiv" style="display:none;">
                        <div class="input-field col s12 m6">
                            <label>Company Name</label>
                            <input name="compName" id="compName" type="text" class="validate" >
                        </div>
                        <div class="input-field col s12 m6">
                            <label>Company Address</label>
                            <input name="compAddress" id="compAddress" type="text" class="validate" >
                        </div>
                    </div>
                    <div class="input-field col s6 m3">
                        <label>Checkin Date</label>
                        <input style="height:36px; line-height:36px;" id="checkindate" name="checkindate" type="text" class="validate datepicker">
                    </div>
                    <div class="input-field col s6 m3">
                        <label>Checkout Date</label>
                        <input style="height:36px; line-height:36px;" id="checkoutdate" name="checkoudate" type="text" class="validate datepicker">
                    </div>
                    <div class="input-field col s6 m3">
                        <label>Adults</label>
                        <input style="height:36px; line-height:36px;" id="adultsCount" name="adultsCount" type="number" class="validate">
                    </div>
                    <div class="input-field col s6 m3">
                        <label>Childrens</label>
                        <input style="height:36px; line-height:36px;" id="childrenCount" name="childrenCount" type="number" class="validate">
                    </div>
                    <div class="input-field col s6 m3">
                        <select id="idTypeSelect" name="personal_id_type">
                            <option value="" disabled selected>Select ID</option>
                            <option value="SSS">SSS</option>
                            <option value="PagIbig">Pag Ibig</option>
                            <option value="Philhealt">Philhealt</option>
                            <option value="Drivers_License">Drivers License</option>
                            <option value="Voters_ID">Voters ID</option>
                        </select>
                    </div>
                    <div class="input-field col s6 m3">
                        <label>Personal ID</label>
                        <input style="height:36px; line-height:36px;" name="personal_id" id="personal_id" type="text" class="validate">
                    </div>
                    
                    <div class="input-field col s6 m6">
                        <a class="btn btn-1 waves-effect waves-green right" onclick="submitReservationModal()"  style="margin-bottom:10px;">
                            <i class="material-icons left" style="margin-right:10px;">
                                send
                            </i>
                            Submit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <!-- modal up to here -->
<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
    <script type="text/javascript" src="includes/js/bookReservation.js"></script>
</section>

</html>