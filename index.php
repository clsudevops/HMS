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
            <div class="col s12">
                <div class="card-1">
                    <div class="page-header valign-wrapper z-depth-1">
                        <h5>Dashboard</h5>
                    </div>
                    <div class="row">
                        <div class="col s12">
                            <div id="roomsList" class="col s12 m9 tabcontainer">
                                    
                            </div>
                            <div class="col s12 m3 tabcontainer">
                                <label style="font-size:16px;">Floor</label>
                                <select name="floor" id="floor" style="height:36px; line-height:36px;">
                                    <?php
                                        for($i = 1 ; $i <= 11 ; $i++){
                                            echo "<option value=" . $i . ">" . $i . "</option>";
                                        }
                                    ?>
                                </select>
                                <div class="file-field input-field" style=" margin-bottom:8px;">
                                    <a class="btn right btn-1" id="searchRoomNo" style="margin-left:5px; height:36px; line-height:36px;">
                                        <i class="material-icons left" style="margin-right:0px;">search</i></a>
                                    <div class="file-path-wrapper" style="padding-left:0px;">
                                        <input placeholder="Room No" id="search" style="height:36px; line-height:36px;" class="validate myinput" type="text"/>
                                    </div>
                                </div>

                                <div>
                                    <ul class="collapsible index-summaries ">
                                        <li class="active">
                                            <div class="collapsible-header"><i class="material-icons">hotel</i>Rooms</div>
                                            <div class="collapsible-body">
                                                <table class="highlight">
                                                    <tr id="vacant" class="status"><td style="width:196px">Vacant</td><td id="vacantCount"></td></tr>
                                                    <tr id="occupied" class="status"><td>Occupied</td><td id="occupiedCount"></td></tr>
                                                    <tr id="cleaning" class="status"><td>Cleaning</td><td id="cleaningCount"></td></tr>
                                                    <tr id="maintenance" class="status"><td>Maintenance</td><td id="maintenanceCount"></td></tr>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="collapsible index-summaries ">
                                        <li>
                                            <div class="collapsible-header"><i class="material-icons">exit_to_app</i>Checking Out</div>
                                            <div class="collapsible-body">
                                                <table class="highlight">
                                                    <tr id="checkingOut"><td style="width:196px">Today's Checkout</td><td id="todaysCheckoutCount"></td></tr>
                                                    <tr id="penalty"><td style="width:196px">Penalty</td><td id="penaltyCount"></td></tr>
                                                </table>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="collapsible index-summaries ">
                                        <li>
                                            <div class="collapsible-header"><i class="material-icons">event_available</i>Available</div>
                                            <div class="collapsible-body">
                                                <table class="highlight" id="bedTypes"></table>
                                            </div>
                                        </li>
                                    </ul>
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
    </footer>
    
    
    <script>
        
    </script>
</body>

<section class="jsIncludes">
    <?php require('jsInclude.php') ?>
    <script type="text/javascript" src="includes/js/index.js"></script>
</section>

</html>