<?php
    if(isset($_POST['deleteRoomType'])) {    
        $id = $_POST['deleteRoomType'];
        $delete = "Delete from roomTypes where id =". $id ." ";
        $result = mysqli_query($conn, $delete);
        // to reload the page and reload the data
        // need to change later
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        echo"<script>window.location.replace('". $actual_link ."');</script>";
    }
?>
<div id="deleteRoomType" class="modal">
    <div class="modal-content">
    <h4>Delete Room Type</h4>
        <table class="z-depth-2 centered highlight responsive-table roomtable">
            <thead>
                <tr>
                    <th>Room Type</th>
                    <th>No. of Beds</th>
                    <th>Rate</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * from roomTypes";
                    $result = mysqli_query($conn, $sql);
                ?>
                <form method="POST">
                    <?php
                
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                    
                                echo "<td>" . $row['type'] . "</td>";
                                echo "<td>" . $row['beds'] . "</td>";
                                echo "<td>" . $row['rate'] . "</td>";
                                echo "<td>
                                            <button type='submit' name='deleteRoomType' class='waves-effect waves-green btn btn-2' value='". $row['id'] . "'>
                                                <i class='material-icons'>
                                                    delete
                                                </i>
                                            </button>
                                        </td>";
                                echo "</tr>";
                            }
                        }
                    ?>
                </form>
            </tbody>
        </table>
    </div>
    <div class="modal-footer">
        <button type="submit" class="modal-close waves-effect waves-green btn btn-1">Cancel</button>
    </div>  
</div>
<script>
    
</script>
<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
</section>