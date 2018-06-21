<!DOCTYPE html>
<html lang="en">

<head>
    <?php include('cssInclude.php') ?>
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
                    <div class="page-header valign-wrapper z-depth-1">
                        <h5>Dashboard</h5>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div id="roomsList" class="col s12 m9 tabcontainer">
                                    
                            </div>
                            <div class="col s12 m3 tabcontainer">
                                <label style="font-size:18px;">Floor</label>
                                <select name="floor" id="floor">
                                    <?php
                                        for($i = 1 ; $i <= 11 ; $i++){
                                            echo "<option value=" . $i . ">" . $i . "</option>";
                                        }
                                    ?>
                                </select>
                                <div>
                                    <h5 class="sum-heading">
                                        Rooms
                                    </h5>
                                    <div class="summary">
                                        <table class="striped highlight">
                                            <tr id="vacant"><td style="width:196px">Vacant</td><td id="vacantCount"></td></tr>
                                            <tr id="occupied"><td>Occupied</td><td id="occupiedCount"></td></tr>
                                            <tr id="cleaning"><td>Cleaning</td><td id="cleaningCount"></td></tr>
                                            <tr id="maintenance"><td>Maintenance</td><td id="maintenanceCount"></td></tr>
                                        </table>
                                    </div>
                                    <h5 class="sum-heading">
                                        Checking out
                                    </h5>
                                    <div class="summary">
                                        <table class="striped highlight">
                                            <tr id="checkingOut"><td style="width:196px">Today's Checkout</td><td id="todaysCheckoutCount"></td></tr>
                                        </table>
                                    </div>
                                    <h5 class="sum-heading">
                                        Available
                                    </h5>
                                    <div class="summary">
                                        <table class="striped highlight" id="bedTypes">
                                            
                                        </table>
                                    </div>
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
        <?php require('pages/modals/roomTypes/addRoomType.php') ?>
        <?php require('pages/modals/roomTypes/deleteRoomType.php') ?>
    </footer>
    
    
    <script>
        
    </script>
</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
    <script type="text/javascript" src="includes/js/index.js"></script>
</section>

</html>