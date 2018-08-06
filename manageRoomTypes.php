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
                        <h5>Manage Room Types</h5>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col s12 m7">
                            <div class="file-field input-field col m12 s12" style="padding-left:0px; padding-right:0px;">
                                <a class="btn right btn-1" id="searchRoomType" style="margin-left:5px; height:36px; line-height:36px;">
                                    <i class="material-icons left">search</i>Search</a>
            
                                <div class="file-path-wrapper">
                                    <input style="height:36px; line-height:36px;" placeholder="Search Room Type" id="search" class="file-path validate myinput" type="text"/>
                                </div>
                            </div>
                            <table class="z-depth-2 highlight roomTypeTable">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Rate</th>
                                        <th>Hourly</th>
                                        <th>Adult</th>
                                        <th>Child</th>
                                        <th style="width:25%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="roomTypeTable">
                                    
                                </tbody>
                            </table>
                            <ul class="pagination right" id="pagination"></ul>
                        </div>

                        <div class="col s12 m5">
                            <div class="col s12 m12" style="margin-bottom:0px;">
                                <label>Name</label>
                                <input name="typeName" style="height:36px; line-height:36px;" id="typeName" type="text" class="validate" required>
                            </div>
                            <div class="col s12 m3" style="margin-bottom:0px;">
                                <label>Rate</label>
                                <input name="maxAdult" style="height:36px; line-height:36px;" id="rate" type="number" class="validate" required>
                            </div>
                            <div class="col s12 m3" style="margin-bottom:0px;">
                                <label>Rate/Hour</label>
                                <input name="maxChildren" style="height:36px; line-height:36px;" id="rateperhour" type="number" class="validate" required>
                            </div>
                            <div class="col s12 m3" style="margin-bottom:0px;">
                                <label>Child</label>
                                <input name="maxAdult" style="height:36px; line-height:36px;" id="maxAdult" type="number" class="validate" required>
                            </div>
                            <div class="col s12 m3" style="margin-bottom:0px;">
                                <label>Adult</label>
                                <input name="maxChildren" style="height:36px; line-height:36px;" id="maxChildren" type="number" class="validate" required>
                            </div>
                            <div class="input-field col s12 m12">
                                <a class="btn right btn-1" id="submitRoomType" style="margin-left:5px; height:36px; line-height:36px;">
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
    </main>
    
    <footer>
        <?php require('pages/layout/footer.php') ?>
        <!-- modals -->
    </footer>
    
</body>
   <div id="updateRoomType" class="modal">
        <div class="modal-content" style="">
            <h4 id="h4-roomNo">Add Item to Room <span id="modalRoomNo"></span></h4>
            <div class="row">
                <div class="input-field col s6 m4">
                    <label>Room Type</label>
                    <input style="height:36px; line-height:36px;" id="upd_roomType" name="description" type="text" class="validate">                        
                </div>
                <div class="input-field col s3 m2">
                    <label>Rate</label>
                    <input style="height:36px; line-height:36px;" id="upd_rate" type="number" class="validate">
                </div>
                <div class="input-field col s3 m2">
                    <label>Rate/Hour</label>
                    <input style="height:36px; line-height:36px;" id="upd_rateperhour" type="number" class="validate">
                </div>
                <div class="input-field col s4 m2">
                    <label>Child</label>
                    <input style="height:36px; line-height:36px;" id="upd_child" type="number" class="validate">
                </div>
                <div class="input-field col s4 m2">
                    <label>Adult</label>
                    <input style="height:36px; line-height:36px;" id="upd_adult" type="number" class="validate">
                </div>
                <div class="input-field col s4 m12">
                    <a class="btn btn-1 waves-effect waves-green right" onclick="updateRoomType()"  style="margin-bottom:10px;">
                        <i class="material-icons left" style="margin-right:10px;">
                            send
                        </i>
                        Submit
                    </a>
                </div>
            </div>
        </div>
    </div>
<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
    <script type="text/javascript" src="includes/js/manageRoomTypes.js"></script>
</section>

</html>