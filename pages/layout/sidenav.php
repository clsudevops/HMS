<ul id="slide-out" class="sidenav sidenav-fixed">
    <li>
        <div class="user-view">
            <span class="name" style="margin:15px 0;"><?php echo $_SESSION["username"]; ?></span>
        </div>
    </li>
    <li><div class="divider user-divider"></div></li>
    <li><a href="index.php"><i class="material-icons">dashboard</i>Dashboard</a></li>
    <!-- <li><a href="index.php"><i class="material-icons">event</i>Reservations</a></li> -->
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header"><i class="material-icons">face</i>Reservations<i class="material-icons right">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="" href="bookReservation.php"><i class="material-icons">assignment</i>Book Reservation</a></li>
                </ul>
                <ul>
                    <li><a class="" href="reservationList.php"><i class="material-icons">list</i>Reservation List</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <ul class="collapsible collapsible-accordion">
        <li>
            <a class="collapsible-header"><i class="material-icons">face</i>Guests<i class="material-icons right">arrow_drop_down</i></a>
            <div class="collapsible-body">
                <ul>
                    <li><a class="modal-trigger" href="guest.php"><i class="material-icons">group</i>Guest List</a></li>
                </ul>
                <ul>
                    <li><a class="modal-trigger" href=""><i class="material-icons">storage</i>Archived Guest</a></li>
                </ul>
            </div>
        </li>
    </ul>
    <li><a href="nextCheckout.php"><i class="material-icons left">event_available</i>Upcoming Checkouts</a></li>
    
    <li><a href="roomManagement.php"><i class="material-icons">hotel</i>Room Management</a></li>

   
        <ul class="collapsible collapsible-accordion">
        <?php if($type == "admin") : ?>
        <!-- settings -->
            <li>
                <a class="collapsible-header"><i class="material-icons">settings</i>Manage<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>  
                        <li><a href="manageRooms.php"><i class="material-icons left">hotel</i>Rooms</a></li>
                        <li><a href="manageRoomTypes.php"><i class="material-icons left">weekend</i>Room Types</a></li>
                        <li><a href="kitchen.php"><i class="material-icons left">restaurant_menu</i>Food Menus</a></li>
                        <li><a href="extras.php"><i class="material-icons left">dns</i>Extras</a></li>
                        <li><a href="roomTypes.php"><i class="material-icons">supervisor_account</i>Accounts</a></li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>
        <!-- reports -->
            <li>
                <a class="collapsible-header"><i class="material-icons">insert_chart</i>Reports<i class="material-icons right">arrow_drop_down</i></a>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="#"><i class="material-icons">info</i>Company Info</a></li>
                        <li><a href="#"><i class="material-icons">store</i>Setup Branch</a></li>
                        <li><a href="#"><i class="material-icons">toys</i>Payroll Rates</a></li>
                    </ul>
                </div>
            </li>
        </ul>

    <li><a href="logout.php"><i class="material-icons left">exit_to_app</i>Log Out</a></li>
</ul> 
