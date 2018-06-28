<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('cssInclude.php') ?>
    <?php
        if(isset($_POST['submitCheckIn'])) {

            // insert into guests table
            $guestname = $_POST['name']; $mobile = $_POST['mobile']; $room_no = $_POST['room_no'];
            $checkOutDate = $_POST['checkOutDate']; $checkOutTime = $_POST['checkOutTime'];
            $adultsCount = $_POST['adultsCount']; $childCount = $_POST['childCount'];

            $sql = "Insert into guests(name,mobile) values('". $guestname ."','". $mobile ."')";
            $result = mysqli_query($conn, $sql);

            // select guest id
            $sql = "select max(id) as id from guests";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    $guest_id = $row['id'];
                }
            }

            // convert checkoutdate
            // $checkOutTime = date("H:i", strtotime($checkOutTime));
            $checkOut = $checkOutDate . " " . $checkOutTime;
            $checkOut = date('Y-m-d H:i', strtotime($checkOut));
            // echo $checkOut;
            // insert into checkin
            $sql = "Insert into checkin(roomNo,guestId,checkOutDate,adultsCount,childrenCount) values('". $room_no ."',". $guest_id .",'". $checkOut ."',". $adultsCount .",". $childCount .")";
            $result = mysqli_query($conn, $sql);

            $sql = "update rooms set status = 'Occupied' where roomNo='". $room_no ."'";
            $result = mysqli_query($conn, $sql);
            
            header('Location:index.php');

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
                    <div class="page-header valign-wrapper z-depth-1">
                        <h5>Check In</h5>
                    </div>
                    <form method="POST">
                        <div class="card card-2">
                            <!-- reservation               
                            <div class="row">
                                <div class="page-header2 valign-wrapper z-depth-1">
                                    <h5>With Reservation</h5>
                                </div>
                                <div class="input-field col s6 m2">
                                    <label>Reservation ID</label>
                                    <input name="reservation_id" id="guest_id" type="text" class="validate">
                                </div>
                            </div> -->
                            <!-- room -->
                            <div class="row">
                                <div class="page-header2 valign-wrapper z-depth-1">
                                    <h5>Room Information</h5>
                                </div>
                                <div class="input-field col s6 m2">
                                    <label>Room No.</label>
                                    <?php
                                        if(isset($_GET['roomNo'])){
                                            $roomNo = $_GET['roomNo'];    
                                            echo'<input name="room_no" id="room_no" type="text" class="validate" required value="'. $roomNo .'">';
                                        }
                                        else{
                                            echo'<input name="room_no"  id="room_no" type="text" class="validate" required>';
                                        }
                                    ?>
                                    
                                </div>
                                <div class="input-field col s12 m4">
                                    <label>Room Type</label>
                                    <input name="room_type" id="room_type" type="text" class="validate" disabled>
                                </div>
                                <div class="input-field col s6 m2">
                                    <label>Floor</label>
                                    <input name="floor" id="floor"type="text" class="validate" disabled>
                                </div>
                                <div class="input-field col s12 m2">
                                    <label>Rate</label>
                                    <input name="rate" id="rate" type="text" class="validate" disabled>
                                </div>
                                <div class="input-field col s12 m2">
                                    <label>Rate/Hour</label>
                                    <input name="rateperhour" id="rateperhour" type="text" class="validate" disabled>
                                </div>
                            </div>
                            <!-- Guest -->
                            <div class="row">
                                <div class="page-header2 valign-wrapper z-depth-1">
                                    <h5>Guest Information</h5>
                                </div>
                                <div class="input-field col s12 m7">
                                    <label>Name</label>
                                    <input name="name" id="name" type="text" class="validate" required>
                                </div>
                                <!-- <div class="input-field col s12 m6">
                                    <label>Address</label>
                                    <input name="address" id="address" type="text" class="validate">
                                </div> -->
                                <div class="input-field col s6 m5">
                                    <label>Contact</label>
                                    <input name="mobile" id="mobile" type="text" class="validate" required>
                                </div>
                                <!-- <div class="input-field col s6 m4">
                                    <label>Email</label>
                                    <input name="email" id="email" type="email" class="validate">
                                </div> -->
                            </div>
                            <!-- Check in Information -->
                            <div class="row">
                                <div class="page-header2 valign-wrapper z-depth-1">
                                    <h5>Check In Details</h5>
                                </div>
                                <div class="input-field col s6 m3">
                                    <label>Check Out Date</label>
                                    <input name="checkOutDate" type="text" class="datepicker" required>
                                </div>
                                <div class="input-field col s6 m3">
                                    <label>Check Out Time</label>
                                    <input name="checkOutTime" type="text" class="timepicker" required>
                                </div>
                                <div class="input-field col s6 m2">
                                    <label>No. of Adults</label>
                                    <input name="adultsCount" type="number" class="validate" required>
                                </div>
                                <div class="input-field col s6 m2">
                                    <label>No. of Childrens</label>
                                    <input name="childCount" type="number" class="validate" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="page-header2 valign-wrapper z-depth-1"></div>
                                <button type="submit" name="submitCheckIn" class="waves-effect waves-green btn btn-2 right">
                                    <i class="material-icons left">send</i>
                                    Check In   
                                </button>
                            </div>
                            <!-- End of card-2 content -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    <!-- Modal Structure -->
        
    </main>
    
    <footer>
        <?php require('pages/layout/footer.php') ?>
    </footer>

    <script>
        function populateRoomDetails(){
             var roomNo = $('#room_no').val();
                $('#room_type').val("");         
                $('#floor').val("");  
                $('#rate').val("");    
                $('#rateperhour').val("");

                $.ajax({                                      
                    url: 'pages/api/getRoomDetails.php',                
                    data: "roomNo=" + roomNo,                                          
                    dataType: 'json',             
                    success: function(data) 
                    {
                        $('#room_type').val(data[0].type);         
                        $('#floor').val(data[0].floor);  
                        $('#rate').val(data[0].rate);
                        $('#rateperhour').val(data[0].rateperhour);       
                    } 
                });
        }
        $(document).ready(function(){
            populateRoomDetails();
            $('#room_no').blur(function(){
                populateRoomDetails();
            });
        });
    </script>
</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
</section>

</html>