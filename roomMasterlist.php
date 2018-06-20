<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('cssInclude.php') ?>
    <?php
        if(isset($_POST['submitModal'])) {
            if(!empty($_POST["room_no"]) && !empty($_POST["room_type"]) && !empty($_POST["floor"])){
                $room_no = $_POST['room_no'];
                $room_type = $_POST['room_type'];
                $floor = $_POST['floor'];
                
                $insert = "insert into rooms(roomNo,roomType,floor) values (". $room_no .", ". $room_type .", ". $floor .")";
                $result = mysqli_query($conn, $insert);
            }
            else{
                echo"
                <script>
                    alert('All fields are required for adding a new room!!!');
                </script>";
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
            <div class="col s12 mycontainer">
                <div class="card-1">
                    <!-- query for roomtype -->
                    <?php
                        $sql = "SELECT type from roomtypes";
                        $result = mysqli_query($conn, $sql);
                    ?>
                    <div class="page-header valign-wrapper z-depth-1">
                        <h5>Room Masterlist</h5>
                    </div>
                    <!-- Filterings -->
                    <div class="row">
                        <div class="file-field input-field col m4 s12">
                            <a class="waves-effect waves btn right btn-1" href="" style="margin-left:5px;">
                                <i class="material-icons left">search</i>Search</a>
        
                            <div class="file-path-wrapper">
                                <input placeholder="Search Room" class="file-path validate myinput" type="text" required />
                            </div>
                        </div>
                        <div class="input-field col m3 s12">
                            <select>
                                <option value="1" disabled selected>Room Type</option>
                                <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            echo "<option value=" . $row["id"] .">". $row["type"] . "</option>";
                                        }
                                    }
                                ?> 
                            </select>
                        </div>
                        <div class="input-field col m3 s12">
                            <select>
                                <option value="" disabled selected>Floor</option>
                                <?php
                                    for($i = 1 ; $i <= 11 ; $i++){
                                        echo "<option value=" . $i . ">" . $i . "</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="file-field input-field col m2 s12">
                            <a class="waves-effect waves-light btn btn-1 modal-trigger right" href="#addRoom">
                                <i class="material-icons left">add</i>Add Room</a>
                        </div>
                    </div>
                    <!-- Table -->
                    <table class="z-depth-2 centered highlight responsive-table roomtable">
                        <thead>
                            <tr>
                                <th>Room No.</th>
                                <th>Room Type</th>
                                <th>No. of Beds</th>
                                <th>Floor</th>
                                <th>Rate</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT A.roomNo,B.type,B.beds,A.floor,B.rate from rooms A inner Join roomtypes B on A.roomType = B.id order by A.roomNo";
                                $result = mysqli_query($conn, $sql);
                            ?>
                            <?php
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                            
                                        echo "<td>" . $row['roomNo'] . "</td>";
                                        echo "<td>" . $row['type'] . "</td>";
                                        echo "<td>" . $row['beds'] . "</td>";
                                        echo "<td>" . $row['floor'] . "</td>";
                                        echo "<td>" . $row['rate'] . "</td>";
                                        echo "<td>
                                                    <a class='waves-effect btn btn-2 tooltipped' data-tooltip='View Details' href='#'>
                                                        <i class='material-icons left'>
                                                            pageview
                                                        </i>View
                                                    </a>
                                                </td>";
                                        echo "</tr>";
                                    }
                                }
                            ?>
                        </tbody>
                    </table>
                    <ul class="pagination right">
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li class="waves-effect"><a href="#!">2</a></li>
                        <li class="waves-effect"><a href="#!">3</a></li>
                        <li class="waves-effect"><a href="#!">4</a></li>
                        <li class="waves-effect"><a href="#!">5</a></li>
                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        
    <!-- Modal Structure -->
        
    </main>
    
    <footer>
        <?php require('pages/layout/footer.php') ?>
        <!-- modals -->
        <?php require('pages/modals/roomMasterlist/addRoom.php') ?>
        <?php require('pages/modals/roomTypes/addRoomType.php') ?>
        <?php require('pages/modals/roomTypes/deleteRoomType.php') ?>
    </footer>


</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
</section>

</html>