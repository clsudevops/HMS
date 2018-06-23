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
                        <div class="col s12 m6">
                            <div class="file-field input-field col m12 s12" style="padding-left:0px; padding-right:0px;">
                                <a class="btn right btn-1" id="searchRoomNo" style="margin-left:5px; height:36px; line-height:36px;">
                                    <i class="material-icons left">search</i>Search</a>
            
                                <div class="file-path-wrapper">
                                    <input style="height:36px; line-height:36px;" placeholder="Search Room" id="search" class="file-path validate myinput" type="text"/>
                                </div>
                            </div>
                            <table class="z-depth-2 highlight responsive-table roomTypeTable">
                                <thead>
                                    <tr>
                                        <th>Room No</th>
                                        <th>Type</th>
                                        <th>Floor</th>
                                        <th>Rate</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="roomTable">
                                    
                                </tbody>
                            </table>
                        </div>

                        <div class="col s12 m6">
                            <div class="row"  style="margin-bottom:5px;">
                                <div class=" col s12 m4" style="margin-bottom:0px;">
                                    <label>Room No:</label>
                                    <input style="height:36px; line-height:36px;" id="roomNo" type="text" class="validate" required>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom:0px;">
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
                            <div class="row">
                                <div class="input-field col s12 m12">
                                    <a class="btn right btn-1" id="submitRoom" style="margin-left:5px; height:36px; line-height:36px;">
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
        </div>
        
    <!-- Modal Structure -->

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



</html>