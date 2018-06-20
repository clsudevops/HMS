<?php
    if(isset($_POST['submitRoomType'])) {
        if(!empty($_POST["types"]) && !empty($_POST["beds"]) && !empty($_POST["rate"])){
            $type = $_POST['types'];
            $beds = $_POST['beds'];
            $rate = $_POST['rate'];
        
            $insert = "insert into roomtypes(type,beds,rate) values ('". $type ."', ". $beds .", ". $rate .")";
            $result = mysqli_query($conn, $insert);
            // to reload the page and reload the data
            // need to change later
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            echo"<script>window.location.replace('". $actual_link ."');</script>";
        }
        else{
            echo"
            <script>
                alert('All fields are required for adding a new room type!!!');
            </script>";
        }
    }
?>
<div id="addRoomType" class="modal">
    <form method="POST">
        <div class="modal-content">
        <h4>Add New Room Type</h4>
            <div class="row">
                <div class="input-field col s6">
                    <input placeholder="Description" name="types" type="text" class="validate">
                </div>
                <div class="input-field col s2">
                    <input placeholder="Beds" name="beds" type="number" class="validate">
                </div>
                <div class="input-field col s4">
                    <input placeholder="Rate" name="rate" type="text" class="validate">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" name="submitRoomType" class="waves-effect waves-green btn btn-1" value="Save">Save</button>
        </div>
    </form>
</div>