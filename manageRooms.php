<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('cssInclude.php') ?>
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
                        <h5>Manage Rooms</h5>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col s12 m7">
                            <div class="file-field input-field col m12 s12" style="padding-left:0px; padding-right:0px;">
                                <a class="btn right btn-1" id="searchRoomNo" style="margin-left:5px; height:36px; line-height:36px;">
                                    <i class="material-icons left">search</i>Search</a>
            
                                <div class="file-path-wrapper">
                                    <input style="height:36px; line-height:36px;" placeholder="Search Room" id="search" class="file-path validate myinput" type="text"/>
                                </div>
                            </div>
                            <table class="z-depth-2 highlight roomTypeTable">
                                <thead>
                                    <tr>
                                        <th>Room #</th>
                                        <th>Type</th>
                                        <th>Floor</th>
                                        <th>Rate</th>
                                        <th>Rate/Hour</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="roomTable">
                                    
                                </tbody>
                            </table>
                        </div>
                        <div class="col s12 m5">
                            <div class="card" style="margin-top:15px;">
                                <h5 class="h5-adding z-depth-1">Add or Update Room</h5>
                                <div class="row" style="padding:0 15px;">
                                    <div class="col s12 m4" style="margin-bottom:0px;">
                                        <label>Room No:</label>
                                        <input style="height:36px; line-height:36px;" id="roomNo" type="text" class="validate" required>
                                    </div>
                                    <div class=" col s12 m4" style="margin-bottom:0px;">
                                        <label>Rate:</label>
                                        <input style="height:36px; line-height:36px;" id="rate" type="text" class="validate" required>
                                    </div>
                                    <div class=" col s12 m4" style="margin-bottom:0px;">
                                        <label>Rate/Hour:</label>
                                        <input style="height:36px; line-height:36px;" id="rateperhour" type="text" class="validate">
                                    </div>
                                </div>
                                <div class="row" style="padding:0 15px;margin-bottom:0px;">
                                    <div class="col s12 m8">
                                        <?php
                                            $sql = "SELECT id,type from roomtypes";
                                            $result = mysqli_query($conn, $sql);
                                        ?>
                                        <label >Select Type</label>
                                        <select id="roomType" style="height:36px; line-height:36px;">
                                            <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while($row = mysqli_fetch_assoc($result)) {
                                                        echo "<option value=" . $row["id"] .">". $row["type"] . "</option>";
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col s12 m4">
                                        <label >Select Floor</label>
                                        <select id="roomFloor" style="height:36px; line-height:36px;">
                                            <?php
                                                for($i = 1 ; $i <= 11 ; $i++){
                                                    echo "<option value=" . $i . ">" . $i . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" style="padding:0 15px;">
                                    <div class="input-field col s12 m12">
                                        <a class="btn right btn-1" id="submitRoom" style="margin-left:5px; height:36px; line-height:36px;">
                                            <i class="material-icons left" style="margin-right:10px;">
                                                save
                                            </i>
                                            save
                                        </a>
                                        <a class="btn right btn-1" id="clearRoom" onclick="clearRoom()" style="margin-left:5px; height:36px; line-height:36px;">
                                            <i class="material-icons left" style="margin-right:10px;">
                                                clear_all
                                            </i>
                                            Clear
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card" style="margin-top:15px;">
                                <h5 class="h5-adding z-depth-1" style="margin-bottom:5px;">Room Inventory</h5>
                                <div class="row" style="padding:0 15px;">
                                    <div class="input-field col s6 m6">
                                        <h5 id="roomtoDisplayInventory" style="height:36px; line-height:36px; margin-left:0;">
                                            <!-- js used here to get details and dynamic header -->
                                        </h5>
                                    </div>
                                    <div class="input-field col s6 m6">
                                        <div id="addInventoryContainer">
                                            <!-- js used here to get details and dynamic button -->
                                        </div>
                                    </div>
                                    <div class="col s12 m12" style="margin-top:0">
                                        <div class="roomInventoryDiv">
                                            <table id="ItemInventoryTable">
                                            
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
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

    <section class="jsIncludes">
        <?php require('jsInclude.php') ?>
        <script type="text/javascript" src="includes/js/manageRooms.js"></script>
    </section>
</body>

 <!-- Modal Structure -->
    <div id="addInventory" class="modal">
        <div class="modal-content" style="">
            <h4 id="h4-roomNo">Add Item to Room <span id="modalRoomNo"></span></h4>
            <div class="row">
                <div class="input-field col s8 m7">
                    <label>Item Description</label>
                    <input style="height:36px; line-height:36px;" id="itemDescription" name="description" type="text" class="validate">                        
                </div>
                <div class="input-field col s4 m2">
                    <label>Quantity</label>
                    <input style="height:36px; line-height:36px;" id="itemQuantity" type="number" class="validate">
                </div>
                <div class="input-field col s4 m3">
                    <a class="btn btn-1 waves-effect waves-green right" onclick="submitItemInventoryModal()"  style="margin-bottom:10px;">
                        <i class="material-icons left" style="margin-right:10px;">
                            send
                        </i>
                        Submit
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div id="updateInventoryModal" class="modal">
        <div class="modal-content" style="">
            <h4 id="h4-roomNo">Update Inventory <span id="modalRoomNo" style="display:none;"></span></h4>
            <div class="row">
                <div class="input-field col s8 m7">
                    <label class="invetoryLabels">Item Description</label>
                    <input style="height:36px; line-height:36px;" id="itemDescription" name="description" type="text" class="validate">                        
                </div>
                <div class="input-field col s4 m2">
                    <label class="invetoryLabels">Quantity</label>
                    <input style="height:36px; line-height:36px;" id="itemQuantity" type="number" class="validate">
                </div>
                <div class="input-field col s4 m3">
                    <a class="btn btn-1 waves-effect waves-green right updateInventoryBtn" onclick="updateItemInventoryModal()" style="margin-bottom:10px;">
                        <i class="material-icons left" style="margin-right:10px;">
                            edit
                        </i>
                        Update
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- modal up to here -->


</html>