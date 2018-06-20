<div id="addRoom" class="modal">
    <form method="POST" id="addRoomModal">
        <?php
            $sql = "SELECT * from roomtypes";
            $result = mysqli_query($conn, $sql);
        ?>
        <div class="modal-content">
        <h4>Add New Room</h4>
            <div class="row">
                <div class="input-field col s4">
                    <input placeholder="Room No" name="room_no" type="text" class="validate">
                </div>
                <div class="input-field col s4">
                    <select name="room_type">
                        <option value="" disabled selected>Room Type</option>
                        <?php
                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo "<option value=" . $row["id"] .">". $row["type"] . "</option>";
                                }
                            }
                        ?> 
                    </select>
                </div>
                <div class="input-field col s4">
                    <select name="floor">
                        <option value="" disabled selected>Floor</option>
                        <?php
                            for($i = 1 ; $i <= 11 ; $i++){
                                echo "<option value=" . $i . ">" . $i . "</option>";
                            }
                        ?>
                        
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <input type="submit" name="submitModal" class="modal-close waves-effect waves-green btn btn-1" value="Save">
        </div>
    </form>
</div>
<script>
    
</script>
<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
</section>